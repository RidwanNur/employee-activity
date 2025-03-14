<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SKP;
use App\Models\Employees;
use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PegawaiController extends Controller
{
    public function index () {
        $user = Auth::user();
        if($user->is_atasan == 1){
            $query_get_bawahan = "SELECT COUNT(*) AS TOTAL FROM employees WHERE NIP_ATASAN = '{$user->nip}'";
        }else {
            $query_get_bawahan = "SELECT 0 AS TOTAL";
        }
        $query_activities = "SELECT COUNT(*) AS TOTAL FROM activities LEFT OUTER JOIN employees ON activities.EMPLOYEE_ID = employees.ID WHERE employees.NIP = '{$user->nip}'";
        $query_activities_approve = "SELECT COUNT(*) AS TOTAL FROM activities LEFT OUTER JOIN employees ON activities.EMPLOYEE_ID = employees.ID WHERE employees.NIP = '{$user->nip}' AND STATUS IS NOT NULL";
        $query_activities_delay = "SELECT COUNT(*) AS TOTAL FROM activities LEFT OUTER JOIN employees ON activities.EMPLOYEE_ID = employees.ID WHERE employees.NIP = '{$user->nip}' AND STATUS IS NULL";

        $get_bawahan = DB::select($query_get_bawahan);
        $get_activities = DB::select($query_activities);
        $get_activities_delay = DB::select($query_activities_delay);
        $get_activities_approve = DB::select($query_activities_approve);
        return view('dashboard', compact('get_bawahan','get_activities','get_activities_delay','get_activities_approve'));
    }

    public function listSKP(Request $request){
        $user = Auth::user();
        // if($request->input()){
        //     $year = $request->input('year');
        //     $query = SKP::whereNull('is_deleted')->where('created_by', $user->nip);
        //     if ($year != 'all') {
        //         $skp = $query->where('year', $year)->get();
        //     }
        //     else{
        //         $skp = $query->get();
        //     }   
        // }
        //     $skp = SKP::whereNull('is_deleted')->where('created_by', $user->nip)->get();

        $query = SKP::query();
        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        $skp = $query->whereNull('is_deleted')->where('created_by', $user->nip)->get();

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $availableYears = DB::table('skp')
        // ->selectRaw('YEAR(created_at) as year')
        ->distinct()
        // ->orderByRaw('YEAR(created_at)')
        ->pluck('year');
        return view('pegawai/skp', compact('skp','monthNames','availableYears'));
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
        
        $employee = Employees::where('nip',Auth::user()->nip)->first();
        if (!$employee) {
            return redirect()->back()->with('error' ,'Data kepegawaian anda tidak ada!');
            }
        $time_now = Carbon::now();
        $checkSKP = SKP::
        where('month', $request->month)
        ->where('year', $request->year)
        ->where('created_by', $employee->nip)
        ->first();

        if ($checkSKP) {
            return redirect()->back()->with('error' ,'Sudah input SKP di bulan dan tahun tersebut!');
        }


       $skp =  SKP::create([
            'employee_id' => $employee->id,
            'name_skp' => $request->name_skp,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => $time_now,
            'created_by' => Auth::user()->nip
        ]);


        return redirect()->back()->with('success' ,'Record inserted successfully.');

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
        
       $skp =  SKP::findOrFail($id);

    //    $employee = Employees::where('nip', Auth::user()->nip)->first();
    //    if (!$employee) {
    //     return redirect()->back()->with('error' ,'Data kepegawaian anda tidak ada!');
    //     }
    //    $checkSKP = SKP::
    //    where('month', $request->month)
    //    ->where('year', $request->year)
    //    ->where('created_by', $employee->nip)
    //    ->first();

    //    if ($checkSKP) {
    //        return redirect()->back()->with('error' ,'Sudah ada SKP di bulan dan tahun tersebut!');
    //    }
       
       $skp->update([
            'name_skp' => $request->name_skp,
            'month' => $request->month,
            'year' => $request->year,
            'updated_at' => Carbon::now()
        ]);


        return redirect()->back()->with('success' ,'Record updated successfully.');

    }

    public function softDeleteSKP($id){
        $skp = SKP::findOrFail($id);
        $skp->update([
            'is_deleted' => 1,
        ]);

        return redirect()->back()->with('success' ,'Record deleted successfully.');
    }  

    public function listActivity(){
        $activities = Activities::whereNull('is_deleted')->where('created_by', Auth::user()->nip)->with('skp')->get();
        $skp = SKP::whereNull('is_deleted')->where('created_by', Auth::user()->nip)->get();
        return view('pegawai/activity', compact('activities', 'skp'));
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
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $employee = Employees::where('nip',Auth::user()->nip)->first();
        if (!$employee) {
            return redirect()->back()->with('error' ,'Data kepegawaian anda tidak ada!');
            }
        // $time_now = Carbon::now();
        // $checkActivity = SKP::where('employee_id', $employee->id)
        // ->where('created_at', $request->created_at)
        // ->first();

        // if ($checkActivity) {
        //     return redirect()->back()->with('error' ,'');

        // }


       $activities =  Activities::create([
            'employee_id' => $employee->id,
            'skp_id' => $request->skp_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'created_by' => Auth::user()->nip,
            'created_name' => Auth::user()->username,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'nip_atasan'=> $employee->nip_atasan,
            'created_at' => Carbon::now()
        ]);


        return redirect()->back()->with('success' ,'Record inserted successfully.');

    }


    public function updateActivity (Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'skp_id' => 'required',
            'activity' => 'required',
            'description' => 'required',
            'start_time' => ['required', 'before:end_time', 'after_or_equal:08:00'],
            'end_time'   => ['required', 'after:start_time', 'before_or_equal:17:00'],
        ],[
            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.before' => 'Jam mulai harus sebelum jam selesai.',
            'start_time.after_or_equal' => 'Jam mulai minimal pukul 08:00.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'end_time.before_or_equal' => 'Jam selesai maksimal pukul 17:00.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
                
        $activities = Activities::findOrFail($id);

       $activities->update([
            'skp_id' => $request->skp_id,
            'activity' => $request->activity,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'updated_at' => Carbon::now()
        ]);


        return redirect()->back()->with('success' ,'Record updated successfully.');

    }

    public function softDeleteActivity ($id){
        $activity = Activities::findOrFail($id);
        $activity->update([
            'is_deleted' => 1,
        ]);
        // $acti->delete();
        return redirect()->back()->with('success' ,'Record deleted successfully.');    
    }  
    
    public function filterActivity(){

    }

    
    public function filterSKP(){

    }


  
    public function listRecap(Request $request){
        
        $year = $request->input('year');
    
    
        $query = Activities::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupByRaw('MONTH(created_at)')
        ->orderByRaw('MONTH(created_at)');
    
        if ($year) {
            $query->whereYear('created_at', $year);
        }
    
        $bulanAktivitas = $query->get();
    
        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April',   5 => 'Mei',      6 => 'Juni',
            7 => 'Juli',    8 => 'Agustus',  9 => 'September',
            10 => 'Oktober',11 => 'November',12 => 'Desember'
        ];
    
    
        $availableYears = DB::table('activities')
        ->selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderByRaw('YEAR(created_at)')
        ->pluck('year');
    
        return view('pegawai.rekap', compact('bulanAktivitas', 'monthNames','availableYears'));
    }
    
    public function ExcelRecap(Request $request){
                $month = $request->month;
    
                $activities = Activities::where('created_by', Auth::user()->nip)->whereMonth('created_at', $month)->get();
                // $activities = Activity::whereMonth('created_at', $request->month)->get();
    
        
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
        
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nama Aktivitas');
                $sheet->setCellValue('C1', 'Deskripsi');
                $sheet->setCellValue('D1', 'Tanggal');
        
                $rowNumber = 2; 
                $no = 1;
                foreach ($activities as $activity) {
                    $sheet->setCellValue('A' . $rowNumber, $no++);
                    $sheet->setCellValue('B' . $rowNumber, $activity->activity);
                    $sheet->setCellValue('C' . $rowNumber, $activity->description);
                    $sheet->setCellValue('D' . $rowNumber, $activity->created_at->format('Y-m-d H:i:s'));
        
                    $rowNumber++;
                }
        
                $writer = new Xlsx($spreadsheet);
        
                $fileName = 'rekap_aktivitas.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment; filename=\"{$fileName}\"");
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');
                exit; 
    
    }

    public function profile(){
        $employees = Employees::where('nip', Auth::user()->nip)->first();
        return view ('profile', compact('employees'));
    }



}
