<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\BestSeller;

class DashboardController extends Controller
{
    public function index(){
        $users = User::where('role', 'Karyawan')->get();;
        $products = Product::all();
        $transactions = Transaction::where('created_at', 'like', date("Y-m-d").'%')->get();
        $updateBestSellers = BestSeller::orderBy('updated_at', 'DESC')->get();
        foreach ($updateBestSellers as $updateBestSeller) {
            $lastMonth = substr($updateBestSeller->updated_at, 5, 2);
            $thisMonth = date("m");
            if ($lastMonth != $thisMonth) {
                $updateBestSeller->day_counter = 0;
                $updateBestSeller->month_counter = 0;
                $updateBestSeller->save();
            }
            else{
                break;
            }
        }
        $bestSellers = BestSeller::orderBy('month_counter', 'DESC')->limit(5)->get();
        $item = "";
        $counter = "";
        $value = 1;
        foreach ($bestSellers as $bestSeller) {
            if ($value == 1) {
                $item = $item."".$bestSeller->product->name;
                $counter = $counter."".$bestSeller->month_counter;
            }
            else {
                $item = $item.",".$bestSeller->product->name;
                $counter = $counter.",".$bestSeller->month_counter;
            }
            $value++;
        }
        return view('dashboard', ['users'=>$users, 'products'=>$products, 'transactions'=>$transactions, 'items'=>$item, 'counters'=>$counter]);
    }
}
