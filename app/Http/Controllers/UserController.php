<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->where("id", "!=", auth()->user()->id)->get();
        return view("admin.user.index", compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view("admin.user.create", compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "role" => "required",
            "email" => "required|email|unique:users",
        ]);

        $password = Hash::make("password");
        User::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "role" => $request['role'],
            "password" => $password
        ]);
        return redirect()->back()->with("success", "User created successfully! Default password is: password");
    }

    public function show(User $user)
    {
        //
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view("admin.user.edit", compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with("success", "Profile Updated Successfully");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
