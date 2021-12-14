<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingHourController extends Controller
{

    public function index()
    {
        // $work = WorkingHour::all();
        $hours = WorkingHour::all();
        // $hours = $work->format('H:i:s');

        // $hour = Carbon::parse($hours['time']);
        // $time = $hour->format('M d Y');
        // $date = Carbon::parse($hours['time'])->toTimeString();                          // 14:15:16

        // $time = $hours->format('H:i:s');
        // dd($time);

        // $time = date('H:i', strtotime($hours));

        return view('working-hour.show', compact('hours'));
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
            'shift' => 'required',
            'hour' => 'required',
        ]);

        $hour = WorkingHour::find($request->id);

        $hour->shift = $request->input('shift');
        $hour->time = ('2021-01-01') .' '. $request->input('hour');

        $hour->save();
        return redirect()->back()->with('update','Data updated successfully!');

    }


    public function destroy($id)
    {
        //
    }
}
