<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Approver;
use App\Models\Employees;
use App\Models\Work_Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index () {
        $employee = "SELECT COUNT(*) AS TOTAL FROM EMPLOYEES";
        $query_activities_approve = "SELECT COUNT(*) AS TOTAL FROM ACTIVITIES WHERE STATUS IS NOT NULL";
        $query_activities_delay = "SELECT COUNT(*) AS TOTAL FROM ACTIVITIES WHERE STATUS IS NULL";
        $query_last_activity = "SELECT ACTIVITIES.CREATED_AT AS TANGGAL, EMPLOYEES.NIP, ACTIVITIES.CREATED_NAME AS NAMA_PEGAWAI, ACTIVITIES.ACTIVITY, ACTIVITIES.DESCRIPTION FROM ACTIVITIES LEFT OUTER JOIN EMPLOYEES ON ACTIVITIES.EMPLOYEE_ID = EMPLOYEES.ID ORDER BY ACTIVITIES.CREATED_AT DESC LIMIT 5";


        $total_employee = DB::select($employee);
        $total_activity_appr = DB::select($query_activities_approve);
        $total_activity_delay = DB::select($query_activities_delay);
        $last_activity = DB::select($query_last_activity);

        return view('dashboard', compact('total_employee','last_activity','total_activity_appr','total_activity_delay'));
    }

    public function listEmployee (){
            $employees = Employees::whereNull('is_deleted')->get();
            $workRegion = Work_Region::all();
            return view('', compact('employees', 'workRegion'));   
        
    }

    public function storeEmployee (Request $request){
        
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric',
            'name' => 'required',
            'region' => 'required',
            'position' => 'required',
            'nip_atasan' => 'nip_atasan',
            'nama_atasan' => 'nama_atasan'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $checkNIP = Employees::where('nip', $request->nip)->first();
        if ($checkNIP) {
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'NIP Sudah terdaftar!'
            ], 409);
        }


       $employee =  Employees::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'region' => $request->region,
            'position' => $request->position,
            'nip_atasan' => $request->nip_atasan,
            'nama_atasan' => $request->nama_atasan,
            'created_at' => Carbon::now,
        ]);

        $user = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make('123456')
        ]);
        $user->assignRole('pegawai');

        $atasan = User::where('nip', $request->nip_atasan)->first();
        if($atasan->hasRole('pegawai')){
            $atasan->syncRoles(['atasan']);
            $atasan->update([
                'is_atasan' => 1,
                'updated_at' => Carbon::now,
            ]);
        }

        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $employee]);

    }

    public function softDeleteEmployee($id){
        $employee = Employees::findOrFail($id);
        $employee->update([
            'is_deleted' => 1,
        ]);

        return redirect()->back()->with(['message' => 'Record deleted successfully.', 'data' => $employee]);
    }  

    public function updateEmployee(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric',
            'name' => 'required',
            'region' => 'required',
            'nip_atasan' => 'nip_atasan',
            'nama_atasan' => 'nama_atasan',
            'position' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $employee = Employees::findOrFail($id);

        $employee->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'region' => $request->region,
            'position' => $request->position,
            'nip_atasan' => $request->nip_atasan,
            'nama_atasan' => $request->nama_atasan,
            'created_at' => Carbon::now,
        ]);

        $user = User::where('nip', $employee->nip)->first();
        $user->update([
            'name' => $request->name,
            'nip' => $request->nip,
        ]);

        $atasan = User::where('nip', $request->nip_atasan)->first();
        if($atasan->hasRole('pegawai')){
            $atasan->syncRoles(['atasan']);
            $atasan->update([
                'is_atasan' => 1,
                'updated_at' => Carbon::now,
            ]);
        }

        return redirect()->back()->with(['message' => 'Record updated successfully.', 'data' => $employee]);

    }

    public function recapActivity(){
        
    }



    public function settingApprover(){
        $employees = Employees::whereNull('is_deleted')->get();
        return view ('admin.set-approver', compact('employees'));
    }

    public function insertApprover(Request $request){
        $validator = Validator::make($request->all(), [
            'employee_atasan_id' => 'required',
            'employee_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $atasan = Employees::where('id', $request->employee_atasan_id);
        $bawahan = Employees::where('id', $request->employee_id);

        $checkAtasanBawahan = Approver::where('employee_atasan_id', $atasan->id)
        ->where('employee_id', $bawahan->id)
        ->first();

        if ($checkAtasanBawahan) {
            return redirect()->back()->with([
                'code' => 409,
                'status' => 'Error',
                'message' => 'Approver sudah ada!'
            ], 409);
        }

       $approver =  Approver::create([
            'employee_atasan_id' => $atasan->id,
            'employee_id' => $bawahan->id,
            'nip_atasan' => $atasan->nip,
            'nip' => $bawahan->nip,
            'position_atasan' => $atasan->position,
            'position' => $bawahan->position,
            'nama' => $bawahan->name,
            'nama_atasan' => $atasan->name,
            'created_at' => Carbon::now,
        ]);

        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $approver]);
    }


        public function updateApprover(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'employee_atasan_id' => 'required',
            'employee_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $atasan = Approver::where('id', $request->employee_atasan_id);
        // $bawahan = Employees::where('id', $request->employee_id);

        $existingApprover = Approver::where('employee_atasan_id', $request->employee_atasan_id)
        ->where('employee_id', $request->employee_id)
        ->first();

        $approver = Approver::findOrFail($id);
       
        $approver->update([
            'nip_atasan' => $existingApprover->nip,
            'nip' => $existingApprover->nip,
            'position_exist$existingApprover' => $existingApprover->position,
            'position' => $existingApprover->position,
            'nama' => $existingApprover->name,
            'nama_atasan' => $existingApprover->name,
            'updated_at' => Carbon::now,
        ]);

        return redirect()->back()->with(['message' => 'Record updated successfully.', 'data' => $approver]);
    }

    public function getReportActivity(){

    }

  

}
