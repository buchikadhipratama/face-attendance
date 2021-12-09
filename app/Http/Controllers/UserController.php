<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.show', compact('users','roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'emailAddress' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($request->id);

        $user->name = $request->input('name');
        $user->email = $request->input('emailAddress');
        $user->role = $request->input('role');

        $user->save();
        return redirect()->back();

    }

    public function delete(Request $request)
    {

        $user = User::find($request->id);
        $user->status = $request->input('Dstatus');
        // dd($request);

        $user->save();
        return redirect()->back();
    }
}
