<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'game_id',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get order yang memiliki item ini.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get game dari item.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
