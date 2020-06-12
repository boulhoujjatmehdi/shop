<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title' , 'price' , 'size' , 'color' , 'description' , 'additional_info' , 'stock' , 'categorie_id'];
}
