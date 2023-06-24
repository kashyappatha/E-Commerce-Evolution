<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Product;

class Productimage extends Model
{
    use HasFactory;
    protected $table = 'productimages';

    protected $fillable=[
        'product_id',
        'image',
        'created_at',
        'updated_at'



    ];
    // public function product()
    // {
    //     return $this->belongsTo(Product::class,'product_id','id');
    // }
}