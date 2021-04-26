<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'img_path'
    ];
    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }
    public function bestseller(){
        return $this->hasOne('App\Models\BestSeller');
    }
}
