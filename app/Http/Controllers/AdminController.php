<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employees;
use App\Models\Work_Region;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index () {
        $employees = Employees::whereNull('is_deleted')->get();
        $workRegion = Work_Region::all();
        return view('admin.dashboard', compact('employees', 'workRegion'));   
    }



    public function storeEmployee (Request $request){
        
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric',
            'name' => 'required',
            'region' => 'required',
            'position' => 'required'
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
            'created_at' => Carbon::now,
        ]);

        $user = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make('123456')
        ]);
        $user->assignRole('pegawai');

        return redirect()->back()->with(['message' => 'Record inserted successfully.', 'data' => $employee]);

    }

    public function softDeleteEmployee($id){
        $employee = Employees::findOrFail($id);
        $employee->update([
            'is_deleted' => 1,
        ]);

        return redirect()->back()->with(['message' => 'Record deleted successfully.', 'data' => $employee]);
    }  

    public function editEmployee(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric',
            'name' => 'required',
            'region' => 'required',
            'position' => 'required'
        ]);

        $employee = Employees::findOrFail($id);

        $employee->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'region' => $request->region,
            'position' => $request->position,
            'created_at' => Carbon::now,
        ]);

        $user = User::where('nip', $employee->nip)->first();
        $user->update([
            'name' => $request->name,
            'nip' => $request->nip,
        ]);

        return redirect()->back()->with(['message' => 'Record updated successfully.', 'data' => $employee]);

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
