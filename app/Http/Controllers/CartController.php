<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    private $messages = [
        'required' => ':attribute tidak boleh kosong!',
        'numeric' => ':attribute harus di isi angka!',
        'min' => ':attribute minimal Rp. 0'
    ];
    public function index(){
        $carts = Cart::get();
        return view('carts.index', ['carts'=>$carts]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'jumlah' => 'required|numeric'
        ], $this->messages);
        $cart = Cart::where('product_id', $request->id)->first();
        if (empty($cart)) {
            Cart::create([
                'product_id' => $request->id,
                'qty' => $request->jumlah,
                'discount' => 0,
                'total' => $request->price * $request->jumlah
            ]);
        }
        else{
            $qtyTotal = $cart->qty + $request->jumlah;
            $cart->qty = $cart->qty + $request->jumlah;
            $cart->total = ($cart->product->price * $qtyTotal) - ($cart->discount * $qtyTotal);
            $cart->save();
        }
        return redirect()->route('transactions.index')->with(['successinsert'=>'Item berhasil ditambahkan!']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'qty' => 'required|numeric',
            'discount' => 'required|numeric|min:0'
        ], $this->messages);
        $cart = Cart::find($request->id);
        $total = ($cart->product->price * $request->qty) - ($request->discount * $request->qty);
        $cart->discount = $request->discount;
        $cart->qty = $request->qty;
        $cart->total = $total;
        $cart->save();
        return redirect()->route('carts.index')->with(['successedit'=> 'Edit item sukses!']);
    }
    public function destroy(Cart $cart){
        $cart->delete();
        return redirect()->route('carts.index')->with(['successdelete'=> 'Delete item sukses!']);
    }
}
