<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'profile_image',
        'name',
        'email',
        'password',
        'country',
        'state',
        'city',
        'Address_1',
        'Address_2',
        'postalcode',
        'phone'


    ];
}
