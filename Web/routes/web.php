<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerStaffs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/homepage', function (){
    return view('homePage');
})->name('homePage');

Route::get('/admin/staffpage', [ControllerStaffs::class, 'listStaff'])->name('staffPage');

Route::get('/admin/staffpage/addstaff', [ControllerStaffs::class, 'addStaffPage'])->name('addStaff');

Route::post('/admin/staffpage/addstaff/submit', [ControllerStaffs::class, 'addStaff']);

Route::get('/admin/camerapage', function(){
    return view('cameraPage');
})->name('cameraPage');

Route::get('/admin/dataserver', [ControllerStaffs::class, 'getServerStaff']);

Route::get('/admin/reportpage', [ControllerStaffs::class, 'reportStaff'])->name('reportPage');
Route::post('/admin/reportpage/submit', [ControllerStaffs::class, 'dateReportStaff']);

Route::get('/admin/staffpage/{MSNV}', [ControllerStaffs::class, 'getMSNVToEdit'])->name('editPage');
Route::post('/admin/staffpage/editstaff/submit', [ControllerStaffs::class, 'editStaff']);
Route::post('/admin/staffpage/staff', [ControllerStaffs::class, 'searchStaff'])->name('searchStaff');
Route::get('/admin/staffpage/delete/{MSNV}', [ControllerStaffs::class, 'deleteStaff'])->name('deleteStaff');

Route::get('/admin/staff/page/detailtimesheet/{MSNV}', [ControllerStaffs::class, 'detaiTimeSheetStaff'])->name('detailTimeSheet');
Route::post('/admin/staffpage/detailtimesheet/submit/{MSNV}', [ControllerStaffs::class, 'dateDetaiTimeSheetStaff']);