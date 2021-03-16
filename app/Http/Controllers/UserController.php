<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Expert;
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
        $users = User::where('is_admin', '!=', 1)
        ->orWhere('is_admin', '=', null)
        ->get();

        $experts = Expert::where('expert_company', 'Era Elektra Corpora Indonesia')
        ->get();
        // dd($expert);

        return view('users.index', compact('users', 'experts'));
    }
     
    public function addData(StoreUserRequest $request){

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
