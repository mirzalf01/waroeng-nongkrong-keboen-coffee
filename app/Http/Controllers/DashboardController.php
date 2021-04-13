<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $users = User::where('role', 'Karyawan')->get();;
        $products = Product::all();
        $transactions = Transaction::where('created_at', 'like', date("Y-m-d").'%')->get();
        return view('dashboard', ['users'=>$users, 'products'=>$products, 'transactions'=>$transactions]);
    }
}
