<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'day_counter',
        'month_counter'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
