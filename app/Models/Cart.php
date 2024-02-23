<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    protected $primaryKey = 'user_id';

    protected function getProducts(): Attribute {
        return Attribute::make(get: function() {
            $userCart = Cart::all()->where('user_id', $this->user_id);
            if($userCart->count() > 0) {
                $cartItems = [];
                foreach($userCart as $item) {
                    $product = Product::find($item->product_id);
                    $quantity = $item->quantity;
                    array_push($cartItems, ['product' => $product, 'quantity' => $quantity]);
                }
                return $cartItems;
            }
            return false;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function calculateTotal(): Attribute {
        return Attribute::make(get: function() {
            $total = 0;
            $userCart = Cart::all()->where('user_id', $this->user_id);
            if($userCart->count() > 0) {
                foreach($userCart as $item) {
                    $product = Product::find($item->product_id);
                    $price = number_format($product->totalPrice * $item->quantity, 2);
                    $total = $total + $price;
                }
                return $total;
            }
        });
    }
}