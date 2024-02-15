<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected function numProducts(): Attribute {
        return Attribute::make(get: function() {
            return Product::where('category_id', $this->id)->count();
        });
    }

    protected function categoryProducts(): Attribute {
        return Attribute::make(get: function() {
            return Product::all()->where('category_id', $this->id);
        });
    }

}