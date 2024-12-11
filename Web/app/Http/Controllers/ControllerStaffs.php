<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use tidy;
use Carbon\Carbon;

class ControllerStaffs extends Controller
{
    function addStaffPage(){
        return view('addStaffPage');
    }

    function listStaff(){
        $staffs = Staff::all();
        return view('staffPage', compact('staffs'));
    }


    function addStaff(Request $request) {
        $input = $request->all();
        if ($request->hasFile('Image')){ 
            $file = $request->file('Image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName);
            $thumbnail = 'public/img/' . $fileName; 
            $input['Image'] = $thumbnail;
        }
    
        if (empty($input['MSNV'])) {
            return response()->json(['error' => 'Field MSNV is required.'], 400);
        }
    
        try {  
            Staff::create([
                'MSNV' => $input['MSNV'], 
                'Name' => $input['Name'] ?? 'Unknown', 
                'Address' => $input['Address'] ?? 'Unknown', 
                'CCCD' => $input['CCCD'] ?? null,
                'Phone' => $input['Phone'] ?? null,
                'Gender' => $input['Gender'] ?? null,
                'Duty' => $input['Duty'] ?? null,
                'Image' => $input['Image'] ?? null, 
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return redirect()->route('staffPage')->with('status', 'Đã thêm thành công');
    }

    function getServerStaff() {
        $response = Http::get('https://servertimekeepingiot.onrender.com/get_data');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timenow = strtotime('now');
        $data = $response->json();
        $date = date('Y-m-d');
        $time = date("H:i:s", $timenow);
        $image = '';
        if (!empty($data['image'])) {
            $base64Image = $data['image'];
            $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
            $imageData = base64_decode($base64Image);
        
            if ($imageData !== false) {
                $outputDir = "C:/xampp/htdocs/IOT_WEB/public/img"; 
                if (!is_dir($outputDir)) {
                    mkdir($outputDir, 0777, true); 
                }
                $randomFileName = "image_" . uniqid() . ".png";
                $outputFile = $outputDir . "/" . $randomFileName;
                file_put_contents($outputFile, $imageData);
                $relativePath = str_replace("C:/xampp/htdocs/IOT_WEB/", '', $outputFile);
                $relativePath = str_replace('\\', '/', $relativePath);
                $image = $relativePath; 
            }
        }
    
        if (!empty($data['userId'])) {
            $staff = Staff::where('MSNV', $data['userId'])->first();
            if ($staff) {
                $name = $staff->Name;
                
                Timesheet::create([
                    'MSNV' => $data['userId'],
                    'Name' => $name,
                    'Time' => $time,
                    'Date' => $date,
                    'Image' => $image
                ]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Staff not found.']);
            }
        }
    
        $timesheets = Timesheet::where('Date', $date)->get();
    
        $postResponse = Http::post('https://servertimekeepingiot.onrender.com/check_data', [
            'status' => 'success'
        ]);
    
        return response()->json(['status' => 'success', 'timesheets' => $timesheets]);
    }

    function getMSNVToEdit($MSNV){
        $staff = Staff::where('MSNV', $MSNV)->first();
        return view('editStaffPage', compact('staff'));
    }

    function editStaff(Request $request){
        $input = $request->all();
        if ($request->hasFile('Image')){ 
            $file = $request->file('Image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName);
            $thumbnail = 'public/img/' . $fileName; 
            $input['Image'] = $thumbnail;
        }
    
        if (empty($input['MSNV'])) {
            return response()->json(['error' => 'Field MSNV is required.'], 400);
        }

        $staff = Staff::where('MSNV', $input['MSNV'])->first();
        if($staff){
            $staff->update($input);
        }
        return redirect()->route('staffPage')->with('status', 'Đã thêm thành công');
    }

    function searchStaff(Request $request){
        $data = $request->input('searchInput');
        if(!empty($data)){
            $staffs = Staff::where('MSNV', $data)->get();
            if($staffs){
                return view('staffPage', compact('staffs'));
            }
        }
        else{
            return redirect()->route('staffPage');
        }
    }

    function deleteStaff($MSNV){
        Staff::where('MSNV', $MSNV)->delete();
        return redirect()->route('staffPage')->with('status', 'Đã xóa thành công');
    }

    public function detaiTimeSheetStaff($MSNV, $inputDate = null) {
        $msnv = $MSNV;
        $date = $inputDate ? Carbon::parse($inputDate) : Carbon::now();
        $formattedDate = $date->format('Y-m');
        $formattedDate1 = $date->format('m-Y');
        $daysInMonth = $date->daysInMonth;
    
        $timesheets = Timesheet::where('MSNV', '=', $MSNV)
                               ->whereRaw('DATE_FORMAT(Date, "%Y-%m") = ?', [$formattedDate])
                               ->get();
        $count = $timesheets->count();
        $deserted = $daysInMonth - $count;
        return view('timeSheetOfStaffPage', compact('timesheets', 'daysInMonth', 'count', 'deserted', 'formattedDate1', 'msnv'));
    }

    public function dateDetaiTimeSheetStaff(Request $request, $MSNV) {
        $msnv = $MSNV;
        $date1 = $request->input('report-date');
        $date = $date1 ? Carbon::parse($date1) : Carbon::now();
        $formattedDate = $date->format('Y-m');
        $formattedDate1 = $date->format('m-Y');
        $daysInMonth = $date->daysInMonth;
    
        $timesheets = Timesheet::where('MSNV', '=', $MSNV)
                               ->whereRaw('DATE_FORMAT(Date, "%Y-%m") = ?', [$formattedDate])
                               ->get();
        $count = $timesheets->count();
        $deserted = $daysInMonth - $count;
        return view('timeSheetOfStaffPage', compact('timesheets', 'daysInMonth', 'count', 'deserted', 'formattedDate1', 'msnv'));
    }

    function reportStaff($inputDate = null) {
        $date = $inputDate ? Carbon::parse($inputDate) : Carbon::now();
        $formattedDate = $date->format('Y-m-d');
        $formattedDate1 = $date->format('d-m-Y');
        $staff = Staff::all();
        $countStaff = $staff->count();
        $timesheetscount = Timesheet::whereRaw('DATE_FORMAT(Date, "%Y-%m-%d") = ?', [$formattedDate])
                       ->distinct('MSNV')
                       ->get(['MSNV']);

        $count = $timesheetscount->count();

        $timesheets = Timesheet::whereRaw('DATE_FORMAT(Date, "%Y-%m-%d") = ?', [$formattedDate])
                               ->get();
        $deserted = $countStaff - $count;
        return view('reportPage', compact('timesheets', 'count', 'countStaff', 'formattedDate1', 'deserted'));
    }

    function dateReportStaff(Request $request, $inputDate = null) {
        $date1 = $request->input('report-date');
        $date = $date1 ? Carbon::parse($date1) : Carbon::now();
        $formattedDate = $date->format('Y-m-d');
        $formattedDate1 = $date->format('d-m-Y');
        $staff = Staff::all();
        $countStaff = $staff->count();
        $timesheetscount = Timesheet::whereRaw('DATE_FORMAT(Date, "%Y-%m-%d") = ?', [$formattedDate])
                       ->distinct('MSNV')
                       ->get(['MSNV']);

        $count = $timesheetscount->count();
        $timesheets = Timesheet::whereRaw('DATE_FORMAT(Date, "%Y-%m-%d") = ?', [$formattedDate])
                               ->get();
        $deserted = $countStaff - $count;
        return view('reportPage', compact('timesheets', 'count', 'countStaff', 'formattedDate1', 'deserted'));
    }
    
    
    
    
}
