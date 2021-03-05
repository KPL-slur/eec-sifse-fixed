<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::where('is_admin', '!=', 1)
        ->orWhere('is_admin', '=', null)
        ->get();
        return view('users.index', compact('user'));
    }
     
    public function addData(StoreUserRequest $request){

        // $request->validate([
        //     'name'=>'required',
        //     'email'=>'required',
        //     'password'=>'required',
        // ]);
        
        // return $request->input();

        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->save();
        $validated = $request->validated();
        // User::create($request->validated());

        return redirect('userManagement')->with('status1', 'Data Created!');
    }
   
    public function deleteData($id){

        $users = DB::table('users')->where('id', $id);
        $users->delete();

        return redirect('userManagement')->with('status3', 'Data Deleted!');
    }
}
