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
        'discount'
    ];

    protected function image(): Attribute {
        return Attribute::make(get: function($value) {
            $filePath = '/storage/product-images/';
            $fileName = $value ? $value : 'no-image.jpg';
            return $filePath . $fileName;
        });
    }
}
