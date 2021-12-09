<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Branch;
use DateTimeZone;
use Carbon\Carbon;
use App\Attendance;
use App\StatusHadir;
use App\AttendanceInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branch = Branch::all();
        $attendance = Attendance::where('user_id', auth()->user()->id)->get();
        // $dateImages = Attendance::where('user_id',auth()->user()->id)->first();
        return view('attendance.branch-employee', compact('attendance','branch'));
    }


    public function create()
    {
        //
    }

    public function absence(Request $request)
    {
        // base64 to image
        $image = $request->photoURI;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = time().'.'.'jpeg';
        $full_path = 'branch/' . $imageName;
        Storage::put($full_path, base64_decode($image));


        // ddd($imageName);

        // declaration for time
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('H:i:s');
        $morningLimit = '07:00:00';
        $shiftLimit = '12:00:00';
        $afternoonLimit = '14:00:00';

        // conditioning
        if(strtotime($time) < strtotime($morningLimit) && strtotime($time) < strtotime($shiftLimit) ) {
            $status = 1; #echo 'Pagi Tepat Waktu'
        } elseif(strtotime($time) > strtotime($morningLimit) && strtotime($time) < strtotime($shiftLimit) ) {
            $status = 2; #echo 'Pagi Terlambat'
        } elseif(strtotime($time) < strtotime($afternoonLimit) && strtotime($time) > strtotime($shiftLimit)) {
            $status = 3; #echo 'Siang Tepat Waktu'
        } elseif(strtotime($time) > strtotime($afternoonLimit) && strtotime($time) > strtotime($shiftLimit)) {
            $status = 4; #echo 'Siang Terlambat'
        }

        // validation for only user
        $employee = Attendance::where([
            ['user_id','=',auth()->user()->id],
            ['date','=',$date],
        ])->first();

        // input data
        if($employee){
            return redirect()->back()->with('already',"You've done attendance before");
        }else{
            Attendance::create([
                'user_id' => auth()->user()->id,
                'date' => $date,
                'start' => $time,
                'images' => $imageName,
                'attendance_info_id' => $status,
                'branch_id' => $request->branch_id,
            ]);
        }
        return redirect()->back()->with('start','You have successfully made attendance today. be enthusiastic at work ^_^');
    }


    public function finishwork()
    {
        $timezone = 'Asia/Makassar';
        $datetime = new DateTime('now',new DateTimeZone($timezone));
        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s');

        $employee = Attendance::where([
            ['user_id','=',auth()->user()->id],
            ['date','=',$date],
        ])->first();

        $finish=[
            'finish' => $time,
            'working_hours' => date('H:i:s', strtotime('-8 hours', strtotime($time)) - strtotime($employee->start))
        ];

        if($employee->finish == ""){
            $employee->update($finish);
            return redirect()->back()->with('finish', 'thank you for your dedication and honesty during work');
        }else{
            return redirect()->back()->with('already',"You've done attendance before");
        }
    }

    public function showList()
    {
        $attendances = Attendance::all();
        $branches = Branch::all();
        $attendances_info = AttendanceInfo::all();
        $users = User::all();

        return view('attendance.employee-attendance-list', compact('attendances','branches','attendances_info','users'));
        # code...
    }

    public function filterList(Request $request)
    {
        $attendances = Attendance::where('date','>=',$request->from)->where('date','<=',$request->to)->get();
        $branches = Branch::all();
        $attendances_info = AttendanceInfo::all();
        $users = User::all();

        return view('attendance.employee-attendance-list', compact('attendances','branches','attendances_info','users'));
        # code...
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


        // dd($request);
        // $date = str_replace('.','-', $request->input('attendanceTime'));
        // $dateFormat = Carbon::createFromFormat('Y-m-d H:i:s', $date);


        // $date = Carbon::parse($request->attendanceTime)->format('Y-m-d H:i:s');
        // $attendance = new Attendance;
        // $attendance->user_id = Auth::user()->id;
        // $attendance->datetime = $date;
        // $attendance->attendance_info_id = 2;
        // $attendance->branch_id = $request->branch_id;
        // $attendance->save();
