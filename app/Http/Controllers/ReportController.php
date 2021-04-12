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
}
