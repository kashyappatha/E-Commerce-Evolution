<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    protected  $table = 'products';

    protected $fillable = [
        'category_id',
        'title',
        'type',
        'brand',
        'small_description',
        'price',
        'quantity',
        'status',
        'product_code',
        'description',
        'image'

    ];
    // Retrieve the form input
    public function productImages(){
        return  $this->hasMany(ProductImage::class,'product_id','id');
    }

}