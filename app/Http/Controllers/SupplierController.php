<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    private $messages = [
        'required' => ':attribute tidak boleh kosong!',
        'max' => ':attribute harus diisi maksimal :max karakter!'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'DESC')->get();
        return view('suppliers.index', ['suppliers'=>$suppliers]);
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
            'no_telp' => 'required|max:13',
        ], $this->messages);
        Supplier::create([
            'name' => ucwords($request->name),
            'no_telp' => $request->no_telp,
            'keterangan' => ucfirst($request->keterangan)
        ]);
        return redirect()->route('suppliers.index')->with(['successinsert'=>'Tambah supplier sukses!']);
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
            'no_telp' => 'required|max:13'
        ], $this->messages);
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->name;
        $supplier->no_telp = $request->no_telp;
        if ($request->keterangan != null) {
            $supplier->keterangan = $request->keterangan;
        }
        else{
            $supplier->keterangan = "";
        }
        $supplier->save();
        return redirect()->route('suppliers.index')->with(['successedit'=> 'Edit supplier sukses!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with(['successdelete'=> 'Delete supplier sukses!']);
    }
}
