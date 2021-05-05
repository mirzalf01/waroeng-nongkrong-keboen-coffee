<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $messages = [
        'required' => ':attribute tidak boleh kosong!'
    ];
    public function index(){
        $users = User::orderBy('role', 'ASC')->get();
        return view('users.index', ['users'=>$users]);
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ], $this->messages);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('users.index')->with(['successedit'=> 'Edit karyawan sukses!']);
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with(['successdelete'=> 'Delete user sukses!']);
    }
}
