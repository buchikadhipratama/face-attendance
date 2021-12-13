<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\WorkingHour;
use Illuminate\Http\Request;

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


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
