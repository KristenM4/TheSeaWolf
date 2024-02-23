<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount',
        'image',
        'thumbnail',
        'category_id'
    ];

    public function getRouteKeyName(){
        return "slug";
    }

    protected function imagePath(): Attribute {
        return Attribute::make(get: function() {
            $filePath = '/storage/product-images/';
            $fileName = $this->image ? $this->image : 'no-image.jpg';
            return $filePath . $fileName;
        });
    }

    protected function totalPrice(): Attribute {
        return Attribute::make(get: function() {
            $discountedAmount = $this->discount * $this->price;
            return number_format($this->price - $discountedAmount, 2);
        });
    }
}
