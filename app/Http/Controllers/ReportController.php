<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function dailyIndex(){
        $reports = Transaction::where('created_at', 'like', date("Y-m-d").'%')->orderBy('created_at', 'DESC')->get();
        return view('reports.daily.index', ['reports'=>$reports]);
    }
    public function monthlyIndex(){
        $reports = Transaction::where('created_at', 'like', date("Y-m").'%')->orderBy('created_at', 'ASC')->get();
        return view('reports.monthly.index', ['reports'=>$reports]);
    }
    public function monthlyFilter($month){
        $reports = Transaction::where('created_at', 'like', $month.'%')->orderBy('created_at', 'ASC')->get();
        return view('reports.monthly.index', ['reports'=>$reports]);
    }
}
