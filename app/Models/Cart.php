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
        'products',
        'user_id'
    ];

    protected function getProducts(): Attribute {
        return Attribute::make(get: function() {
            if(!empty($this->products)) {
                $products_array = explode(',', $this->products);
                array_pop($products_array);
                $formatted_products = [];
                foreach($products_array as $product) {
                    $product_and_quantity = explode(' ', $product);
                    $product = Product::find($product_and_quantity[0]);
                    $formatted_product_and_quantity = [
                        'product' => $product,
                        'quantity' => $product_and_quantity[1]
                    ];
                    array_push($formatted_products, $formatted_product_and_quantity);
                }
                return $formatted_products;
            }
            return false;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}