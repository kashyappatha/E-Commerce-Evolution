<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected  $table ="products";

    protected $fillable=[
        'categoy_id',
        'title',
        'brand',
        'small_description',
        'descryption',
        'orignal_price',
        'selling_price',
        'product_id',
        'quantity',
        'status'
    ];

}