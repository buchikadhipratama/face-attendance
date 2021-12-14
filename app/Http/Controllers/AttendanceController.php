<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Branch;
use DateTimeZone;
use Carbon\Carbon;
use App\Attendance;
use App\StatusHadir;
use App\WorkingHour;
use App\AttendanceInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // $articles = Article::latest()->paginate(10)->groupBy(function($article){
        //     return $article->created_at->format('M');});


        // $dateImages = Attendance::where('user_id',auth()->user()->id)->first();


        // $users = DB::table('attendances')->simplePaginate(15);

        // DB::table('attendances')
        //     ->join('branch', 'attendances.id', '=', 'branch.branch_id')
        //     ->select('users.id', 'contacts.phone', 'orders.price')
        //     ->get();


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

        // declaration for time
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('H:i:s');

        $hour = WorkingHour::all();

        $pagi = date('H:i:s', strtotime($hour[0]->time ));
        $siang = date('H:i:s', strtotime($hour[1]->time ));
        $sore = date('H:i:s', strtotime($hour[2]->time ));

        // get pagi hour
        $getPagi = DB::table('working_hours')->where('id', 1)->first();
        $pagi = date('H:i:s', strtotime($getPagi->time )) ;

        // get siang hour
        $getSiang = DB::table('working_hours')->where('id', 2)->first();
        $siang = date('H:i:s', strtotime($getSiang->time )) ;

        // get sore hour
        $getSore = DB::table('working_hours')->where('id', 3)->first();
        $sore = date('H:i:s', strtotime($getSore->time )) ;

        // conditioning
        if(strtotime($time) < strtotime($pagi) && strtotime($time) < strtotime($siang) ) {
            $status = 1; #echo 'Pagi Tepat Waktu'
        } elseif(strtotime($time) > strtotime($pagi) && strtotime($time) < strtotime($siang) ) {
            $status = 2; #echo 'Pagi Terlambat'
        } elseif(strtotime($time) < strtotime($sore) && strtotime($time) > strtotime($siang)) {
            $status = 3; #echo 'Siang Tepat Waktu'
        } elseif(strtotime($time) > strtotime($sore) && strtotime($time) > strtotime($siang)) {
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
