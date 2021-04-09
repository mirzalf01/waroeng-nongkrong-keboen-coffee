<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;

class TransactionController extends Controller
{
    public function index(){
        $foods = Product::where('category', 'Makanan')->orderBy('name', 'ASC')->get();
        $drinks = Product::where('category', 'Minuman')->orderBy('name', 'ASC')->get();
        $carts = Cart::get();
        $total = $carts->sum('total');
        return view('transactions.index', ['foods'=>$foods, 'drinks'=>$drinks, 'carts'=>$carts, 'total'=>$total]);
    }
}
