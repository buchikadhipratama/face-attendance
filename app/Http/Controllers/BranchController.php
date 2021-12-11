<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.show', compact('branches'));
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

            // $this->validate($request,[
            //     'branch_name' => 'required',
            //     'branch_address' => 'required',
            //     'branch_phone' => 'required',
            // ]);

            $branch = Branch::find($request->id);

            $branch->branch_name = $request->input('branch_name');
            $branch->alamat = $request->input('branch_address');
            $branch->phone = $request->input('branch_phone');

            $branch->save();

            return view('users.show');
    }


    public function delete(Request $request)
    {
        $branch = Branch::find($request->id);
        $branch->status = 2;
        // dd($request);

        $branch->save();
        return redirect()->back();
    }
}
