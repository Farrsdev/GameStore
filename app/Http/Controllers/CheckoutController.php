<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * CheckoutController - Handle checkout flow dengan atomic transaction.
 * 
 * Flow:
 * 1. GET /checkout - Show checkout page (review order)
 * 2. POST /checkout/process - Process payment (dummy) & create order
 */
class CheckoutController extends Controller
{
    /**
     * Show checkout page dengan order review.
     */
    public function show(Request $request)
    {
        $cart = session()->get('cart', []);

        // Validate cart tidak kosong
        if (empty($cart)) {
            return redirect()->route('cart.view')
                ->with('error', 'Cart kosong!');
        }

        $checkoutService = new CheckoutService();

        // Get game details untuk display
        $games = \App\Models\Game::whereIn('id', array_column($cart, 'game_id'))->get();

        $items = [];
        $totalPrice = 0;

        foreach ($cart as $item) {
            $game = $games->find($item['game_id']);
            if ($game) {
                $itemTotal = $game->price * $item['quantity'];
                $items[] = [
                    'game' => $game,
                    'quantity' => $item['quantity'],
                    'itemTotal' => $itemTotal,
                ];
                $totalPrice += $itemTotal;
            }
        }

        return view('checkout', compact('items', 'totalPrice'));
    }

    /**
     * Process checkout dengan dummy payment.
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        // Validate cart
        if (empty($cart)) {
            return redirect()->route('cart.view')
                ->with('error', 'Cart kosong!');
        }

        try {
            // Process checkout menggunakan service (dengan atomic transaction)
            $checkoutService = new CheckoutService();
            $order = $checkoutService->checkout(auth()->user(), $cart);

            // Clear cart dari session
            session()->forget('cart');

            return redirect()->route('user.dashboard')
                ->with('success', 'Pembelian berhasil! Order #' . $order->id);

        } catch (\Exception $e) {
            return redirect()->route('checkout.show')
                ->with('error', $e->getMessage());
        }
    }
}
