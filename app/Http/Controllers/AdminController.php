<?php

namespace App\Http\Controllers;

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
        // $user = auth()->user()->name;
        // return $user->getRoleNames();
        $users = User::with('roles')->get();;
        return $users;
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



    public function settingSkp(){
        
    }

    public function getReportActivity(){

    }

  

}
