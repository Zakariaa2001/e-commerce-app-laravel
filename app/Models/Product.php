<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];
    public function productImages()
    {
        return $this->hasMany(Product_image::class,'product_id','id');
    }
    public function productColors()
    {
        return $this->hasMany(Product_Color::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}