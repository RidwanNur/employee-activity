<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SKP;
use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index () {
        $user = Auth::user();
        if($user->is_atasan == 1){
            $query_get_bawahan = "SELECT COUNT(*) AS TOTAL FROM EMPLOYEES WHERE NIP_ATASAN = '{$user->nip}'";
        }else {
            $query_get_bawahan = "SELECT 0 AS TOTAL";
        }
        $query_activities = "SELECT COUNT(*) AS TOTAL FROM ACTIVITIES LEFT OUTER JOIN EMPLOYEES ON ACTIVITIES.EMPLOYEE_ID = EMPLOYEES.ID WHERE EMPLOYEES.NIP = '{$user->nip}'";
        $query_activities_approve = "SELECT COUNT(*) AS TOTAL FROM ACTIVITIES LEFT OUTER JOIN EMPLOYEES ON ACTIVITIES.EMPLOYEE_ID = EMPLOYEES.ID WHERE EMPLOYEES.NIP = '{$user->nip}' AND STATUS IS NOT NULL";
        $query_activities_delay = "SELECT COUNT(*) AS TOTAL FROM ACTIVITIES LEFT OUTER JOIN EMPLOYEES ON ACTIVITIES.EMPLOYEE_ID = EMPLOYEES.ID WHERE EMPLOYEES.NIP = '{$user->nip}' AND STATUS IS NULL";

        $get_bawahan = DB::select($query_get_bawahan);
        $get_activities = DB::select($query_activities);
        $get_activities_delay = DB::select($query_activities_delay);
        $get_activities_approve = DB::select($query_activities_approve);
        return view('dashboard', compact('get_bawahan','get_activities','get_activities_delay','get_activities_approve'));
    }

    public function listSKP(){
        return view('pegawai/skp');
    }

    
    public function storeSKP (Request $request){
        
        $validator = Validator::make($request->all(), [
            'name_skp' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $employee = Employee::findorFail(Auth::user()->id);
        $time_now = Carbon::now();
        $checkSKP = SKP::where('employee_id', $employee->id)
        ->where('month', $time_now->month)
        ->where('year', $time_now->year)
        ->first();

        if ($checkSKP) {
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'SKP sudah ada di bulan dan tahun tersebut!'
            ], 409);
        }


       $skp =  SKP::create([
            'employee_id' => $employee->id,
            'name_skp' => $request->name_skp,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $skp]);

    }


    public function updateSKP (Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'name_skp' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        

        if($request->total_working_day > 28){
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'Hari kerja melebihi ketentuan!'
            ], 409);
        }

       $skp =  SKP::findOrFail($id);
       
       $skp->update([
            'name_skp' => $request->name_skp,
            'month' => $request->month,
            'year' => $request->year,
            'updated_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record updated successfully.', 'data' => $skp]);

    }

    public function softDeleteSKP($id){
        $skp = SKP::findOrFail($id);
        $skp->update([
            'is_deleted' => 1,
        ]);

        return redirect()->back()->with(['message' => 'Record deleted successfully.', 'data' => $skp]);
    }  


    public function listActivity(){
        return view('pegawai/activity');
    }

    
    public function storeActivity (Request $request){
        
        $validator = Validator::make($request->all(), [
            'skp_id' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'start_time' => ['required', 'date_format:H:i', 'before:end_time', 'after_or_equal:08:00'],
            'end_time'   => ['required', 'date_format:H:i', 'after:start_time', 'before_or_equal:17:00'],
        ],[
            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:MM.',
            'start_time.before' => 'Jam mulai harus sebelum jam selesai.',
            'start_time.after_or_equal' => 'Jam mulai minimal pukul 08:00.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.date_format' => 'Format jam selesai harus HH:MM.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'end_time.before_or_equal' => 'Jam selesai maksimal pukul 17:00.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $employee = Employee::findorFail(Auth::user()->id);
        $time_now = Carbon::now();
        $checkActivity = SKP::where('employee_id', $employee->id)
        ->where('created_at', $time_now)
        ->first();

        if ($checkActivity) {
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'Anda sudah membuat aktivitas harian!'
            ], 409);
        }


       $activities =  Activities::create([
            'employee_id' => $employee->id,
            'skp_id' => $request->skp_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'created_name' => Auth::user()->username,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'created_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $activities]);

    }


    public function updateActivity (Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'skp_id' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'start_time' => ['required', 'date_format:H:i', 'before:end_time', 'after_or_equal:08:00'],
            'end_time'   => ['required', 'date_format:H:i', 'after:start_time', 'before_or_equal:17:00'],
        ],[
            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:MM.',
            'start_time.before' => 'Jam mulai harus sebelum jam selesai.',
            'start_time.after_or_equal' => 'Jam mulai minimal pukul 08:00.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.date_format' => 'Format jam selesai harus HH:MM.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'end_time.before_or_equal' => 'Jam selesai maksimal pukul 17:00.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $activities = Activities::findOrFail($id);

       $activities->update([
            'skp_id' => $request->skp_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'created_name' => Auth::user()->username,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'updated_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $activities]);

    }

    public function filterActivity(){

    }

    
    public function filterSKP(){

    }


    public function recapActivity(){
        return view('pegawai.rekap');
    }



}
