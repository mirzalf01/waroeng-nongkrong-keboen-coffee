<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use File;

class ProductController extends Controller
{
    private $messages = [
        'required' => ':attribute tidak boleh kosong!',
        'max' => ':attribute harus diisi maksimal :max karakter!',
        'numeric' => ':attribute harus diisi dengan angka!',
        'file' => ':attribute merupakan tipe file!',
        'mimes' => ':attribute format yang diterima :mimes!',
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|max:30',
            'price' => 'required|numeric'
        ], $this->messages);
        $fileName = "default.jpg";
        if (!empty($request->image)) {
            $file = $request->image;
            $fileName = time()."_".$file->getClientOriginalName();
            $path = 'gambar_produk';
            $file->move($path, $fileName);
        }
        Product::create([
            'name' => ucwords($request->name),
            'img_path' => $fileName,
            'category' => $request->category,
            'description' => ucfirst($request->description),
            'price' => $request->price,
        ]);
        return redirect()->route('products.index')->with(['successinsert'=>'Tambah produk sukses!']);
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
        $this->validate($request,[
            'name' => 'required|max:50',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|max:30',
            'price' => 'required|numeric'
        ], $this->messages);
        $product = Product::find($request->id);
        $fileName = $product->img_path;
        if (!empty($request->image)) {
            File::delete('gambar_produk/'.$product->$fileName);
            $file = $request->image;
            $fileName = time()."_".$file->getClientOriginalName();
            $path = 'gambar_produk';
            $file->move($path, $fileName);
            $product->img_path = $fileName;
        }
        $product->name = ucwords($request->name);
        $product->category = $request->category;
        $product->description = ucfirst($request->description);
        $product->price = $request->price;
        $product->save();
        return redirect()->route('products.index')->with(['successedit'=> 'Edit produk sukses!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        File::delete('gambar_produk/'.$product->img_path);
        $product->delete();
        return redirect()->route('products.index')->with(['successdelete'=> 'Delete produk sukses!']);
    }
}
