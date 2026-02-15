<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

/**
 * CartController - Handle cart session operations.
 * Session structure: session('cart') = [
 *   {game_id: 1, quantity: 1},
 *   {game_id: 2, quantity: 2},
 *   ...
 * ]
 */
class CartController extends Controller
{
    /**
     * Add game ke cart (session-based).
     */
    public function add(Request $request, Game $game)
    {
        $cart = session()->get('cart', []);

        // Cek apakah user sudah membeli game ini (tidak bisa add ke cart)
        $alreadyOwned = auth()->user()->games()
            ->where('game_id', $game->id)
            ->exists();

        if ($alreadyOwned) {
            return redirect()->back()->with('error', 'Anda sudah memiliki game ini!');
        }

        // Cek apakah game sudah ada di cart
        $key = array_search($game->id, array_column($cart, 'game_id'));

        if ($key !== false) {
            // Game sudah ada, increment quantity
            $cart[$key]['quantity']++;
        } else {
            // Game baru, add ke cart
            $cart[] = [
                'game_id' => $game->id,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Game ditambahkan ke cart!');
    }

    /**
     * Remove game dari cart.
     */
    public function remove(Request $request, Game $game)
    {
        $cart = session()->get('cart', []);

        // Remove game dari cart berdasarkan game_id
        $cart = array_filter($cart, function ($item) use ($game) {
            return $item['game_id'] != $game->id;
        });

        // Reset array keys
        $cart = array_values($cart);

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Game dihapus dari cart!');
    }

    /**
     * View cart page.
     */
    public function view()
    {
        $cart = session()->get('cart', []);

        // Get game details untuk cart items
        $games = Game::whereIn('id', array_column($cart, 'game_id'))->get();

        // Build cart dengan details
        $cartItems = [];
        $totalPrice = 0;

        foreach ($cart as $item) {
            $game = $games->find($item['game_id']);
            if ($game) {
                $itemTotal = $game->price * $item['quantity'];
                $cartItems[] = [
                    'game' => $game,
                    'quantity' => $item['quantity'],
                    'itemTotal' => $itemTotal,
                ];
                $totalPrice += $itemTotal;
            }
        }

        return view('cart', compact('cartItems', 'totalPrice'));
    }
}
