<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'category',
        'image',
        'status',


    ];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
