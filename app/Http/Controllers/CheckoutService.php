<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Checkout Service - Pisahkan logic dari controller untuk clean architecture.
 * Handle atomic transaction untuk checkout process.
 */
class CheckoutService
{
    /**
     * Process checkout dengan validation, create order, attach games, reduce stock.
     * 
     * Proses:
     * 1. Validate semua items (stock, already owned)
     * 2. Create order record
     * 3. Create order items
     * 4. Attach games ke user (user_games pivot)
     * 5. Decrement stock
     */
    public function checkout(User $user, array $cartItems): Order
    {
        return DB::transaction(function () use ($user, $cartItems) {
            $totalPrice = 0;
            $orderItems = [];

            // Validasi semua game sebelum membuat order (fail-fast approach)
            foreach ($cartItems as $item) {
                $game = Game::findOrFail($item['game_id']);

                // Validasi stock mencukupi
                if ($game->stock < $item['quantity']) {
                    throw new \Exception("Stock tidak cukup untuk {$game->title}");
                }

                // Validasi user belum memiliki game ini (tidak bisa beli 2x)
                $alreadyOwned = $user->games()
                    ->where('game_id', $game->id)
                    ->exists();

                if ($alreadyOwned) {
                    throw new \Exception("Anda sudah memiliki {$game->title}");
                }

                $itemTotal = $game->price * $item['quantity'];
                $totalPrice += $itemTotal;

                $orderItems[] = [
                    'game_id' => $game->id,
                    'price' => $game->price,
                    'quantity' => $item['quantity'],
                ];
            }

            // Create order dengan status 'paid' (karena dummy payment)
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'paid',
            ]);

            // Create order items (detail masing-masing game dalam order)
            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            // Attach games ke user & reduce stock
            foreach ($cartItems as $item) {
                $game = Game::find($item['game_id']);

                // Attach ke pivot table user_games
                $user->games()->attach($game->id);

                // Kurangi stock
                $game->decrement('stock', $item['quantity']);
            }

            return $order;
        });
    }
}
