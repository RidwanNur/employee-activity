<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SKP;
use App\Models\Activities;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index () {
        return view('pegawai/dashboard');
    }

    public function listSKP(){
        return view('pegawai/dashboard');
    }

    
    public function storeSKP (Request $request){
        
        $validator = Validator::make($request->all(), [
            'name_skp' => 'required',
            'month' => 'required',
            'year' => 'required',
            'total_working_day' => 'required|numeric'
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

        if($request->total_working_day > 28){
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'Hari kerja melebihi ketentuan!'
            ], 409);
        }

       $skp =  SKP::create([
            'employee_id' => $employee->id,
            'name_skp' => $request->name_skp,
            'month' => $request->month,
            'year' => $request->year,
            'total_working_day' => $request->total_working_day,
            'created_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $skp]);

    }


    public function updateSKP (Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'name_skp' => 'required',
            'month' => 'required',
            'year' => 'required',
            'total_working_day' => 'required|numeric'
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
            'total_working_day' => $request->total_working_day,
            'updated_at' => Carbon::now
        ]);


        return redirect()->back()->with(['message' => 'Record updated successfully.', 'data' => $skp]);

    }


    public function listActivity(){
        return view('pegawai/dashboard');
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



}
