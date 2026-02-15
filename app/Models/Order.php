<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get user yang membuat order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get items dalam order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
