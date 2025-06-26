<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\nhahang\NhaHangController;
use App\Http\Controllers\mang\mangcontroller;
use App\Http\Controllers\hping\myPingController;
use App\Http\Controllers\hping1\myPingController1;
use App\Http\Controllers\camera\cameraController;
use App\Http\Controllers\logdangnhap\LogController;
use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\ExportController;


Route::get('', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');   


// Cho các chức năng muốn sử dụng thì phải qua đăng nhập
Route::middleware(['auth','role'])->group(function () {

    Route::get('/nhahang', [NhaHangController::class, 'index'])->name('dsnhahang');
    Route::get('/nhahang/{id}/edit', [NhaHangController::class, 'edit'])->name('nhahang.edit');
    Route::post('/nhahang/{id}/update', [NhaHangController::class, 'update'])->name('nhahang.update');
    Route::get('/nhahangcreate', [NhaHangController::class, 'create'])->name('nhahangcreate');
    Route::post('/nhahang/store', [NhaHangController::class, 'store'])->name('nhahang.store');
    Route::delete('/nhahang/{id}', [NhaHangController::class, 'destroy'])->name('nhahang.destroy');
    Route::post('/checknhahang', [NhaHangController::class, 'checknhahang'])->name('check.nhahang'); //check tên khi create
    
    Route::get('/mang', [mangcontroller::class, 'index'])->name('dsmang');
    Route::get('/mang/{id}/edit', [mangcontroller::class, 'edit'])->name('mang.edit');
    Route::post('/mang/{id}/update', [mangcontroller::class, 'update'])->name('mang.update');
    Route::get('/mangcreate', [mangcontroller::class, 'create'])->name('mangcreate');
    Route::post('/mang/store', [mangcontroller::class, 'store'])->name('mang.store');
    Route::delete('/mang/{id}', [mangcontroller::class, 'destroy'])->name('mang.destroy');
    Route::post('/checkmang', [mangcontroller::class, 'checkmang'])->name('check.mang'); //check tên khi create

    Route::get('/ping', [myPingController::class, 'index'])->name('ping');
    Route::get('/ping-status/{ip}', [myPingController::class, 'pingStatus'])->name('pingStatus');;
    Route::get('/pingcreate', [myPingController::class, 'create'])->name('pingcreate');
    Route::post('/ping/store', [myPingController::class, 'store'])->name('ping.store');
    Route::get('/ping/{id}/edit', [myPingController::class, 'edit'])->name('ping.edit');
    Route::post('/ping/{id}/update', [myPingController::class, 'update'])->name('ping.update');
    Route::delete('/ping/{id}', [myPingController::class, 'destroy'])->name('ping.destroy');

    Route::get('/pingcreatetm', [myPingController::class, 'createtm'])->name('pingcreatetm');
    Route::post('/ping/storetm', [myPingController::class, 'storetm'])->name('ping.storetm');
    Route::get('/ping/{id}/edittm', [myPingController::class, 'edittm'])->name('ping.edittm');
    Route::post('/ping/{id}/updatetm', [myPingController::class, 'updatetm'])->name('ping.updatetm');
    Route::delete('/ping/{id}/destroytm', [myPingController::class, 'destroytm'])->name('ping.destroytm');

    Route::get('/camera', [cameraController::class, 'index'])->name('dscamera');
    Route::get('/camera/{id}/edit', [cameraController::class, 'edit'])->name('camera.edit');
    Route::post('/camera/{id}/update', [cameraController::class, 'update'])->name('camera.update');
    Route::get('/cameracreate', [cameraController::class, 'create'])->name('cameracreate');
    Route::post('/camera/store', [cameraController::class, 'store'])->name('camera.store');
    Route::delete('/camera/{id}', [cameraController::class, 'destroy'])->name('camera.destroy');

    Route::get('/db', [dashboardController::class, 'index'])->name('db'); //Route index dashboard

    Route::get('/logs', [LogController::class, 'index'])->name('logdn'); // Route index log đăng nhập
    Route::get('/logs/data', [LogController::class, 'fetchLogs'])->name('logs.data'); //route fetch dữ liệu view log cập nhật trạng thái mới liên tục
    
    Route::get('/mangs/export', [mangcontroller::class, 'export'])->name('mangs.export'); // Route xuất dữ liệu từ bảng Mang
    Route::get('/nhahangs/export', [NhahangController::class, 'export'])->name('nhahangs.export'); // Route xuất dữ liệu từ bảng Nhahang
    Route::get('/cameras/export', [cameraController::class, 'export'])->name('cameras.export'); // Route xuất dữ liệu từ bảng camera
    Route::get('/logs/export', [LogController::class, 'exportLogs'])->name('logs.export'); // Route export excel từ log
   
    Route::get('/user-permissions', [UserPermissionController::class, 'index'])->name('user.permissions.index'); //Route cho xem phân quyền
    Route::post('/user-permissions/{userId}', [UserPermissionController::class, 'update'])->name('user.permissions.update'); // Route cho update phân quyền

    Route::get('/export/nhahangpdf', [ExportController::class, 'nhahangPDF'])->name('nhahangs.pdf'); //Route xuất pdf bảng nhahang
    Route::get('/export/mangpdf', [ExportController::class, 'mangPDF'])->name('mangs.pdf'); //Route xuất pdf bảng mang
    Route::get('/export/camerapdf', [ExportController::class, 'cameraPDF'])->name('cameras.pdf'); //Route xuất pdf bảng mang
});

