<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $foods = Product::where('category', 'Makanan')->orderBy('name', 'ASC')->get();
        $drinks = Product::where('category', 'Minuman')->orderBy('name', 'ASC')->get();
        $snacks = Product::where('category', 'Cemilan')->orderBy('name', 'ASC')->get();
        $carts = Cart::all();
        $discount = Cart::sum(\DB::raw('qty * discount'));
        return view('transactions.index', ['foods'=>$foods, 'drinks'=>$drinks, 'carts'=>$carts, 'discount'=>$discount, 'snacks'=>$snacks]);
    }
    public function store(Request $request){
        $carts = Cart::all();
        $invoice = "INV".date('ymd');
        $findStr2 = Transaction::where('invoice', 'like', '%' . $invoice . '%')->orderBy('created_at', 'desc')->first();
        if($findStr2 === null){
            $invoice = $invoice."0001";
        }
        else{
            $findStr3 = $findStr2->invoice;
            $strNum = substr($findStr3, 9, 13);
            $strNum = $strNum+1;
            $invoice = $invoice."".sprintf('%04s', $strNum);
        }
        $listProduct = "";
        $iterator = 1;
        foreach ($carts as $cart) {
            if ($iterator === count($carts)) {
                $listProduct = $listProduct." ".$cart->product->name." Rp. ".number_format($cart->product->price, 0, ".", ".")." x".$cart->qty;
            }
            else{
                $listProduct = $listProduct." ".$cart->product->name." Rp. ".number_format($cart->product->price, 0, ".", ".")." x".$cart->qty.",";
            }
            $iterator++;
        }
        Transaction::create([
            'invoice' => $invoice,
            'list_product' => $listProduct,
            'discount' => $request->discount,
            'price' => $request->price,
            'user_id' => $request->user_id
        ]);
        Cart::truncate();
        return redirect()->route('transactions.index')->with(['successinsert'=>'Proses transaksi sukses!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }
}
