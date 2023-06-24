<?php

namespace App\Models;
// use  App\Models\productImage;
// use App\Models\category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected  $table ="products";

    protected $fillable=[
        'categoy_id',
        'images',
        'title',
        // 'image',
        'brand',
        'small_description',
        'description',
        'orignal_price',
        'selling_price',
        'product_code',
        'quantity',
        'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function productImages()
    {
        return $this->hasMany(Productimage::class , 'product_id','id');

    }
    // public function products()
    // {
    //     return $this->belongsTo(Product::class);
    // }

}