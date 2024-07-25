<?php

use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

route::group(['middleware' => 'auth'],function(){
    Route::get('/index', [App\Http\Controllers\PresencesController::class,'index'])->name('presence');
    Route::post('/scan', [App\Http\Controllers\PresencesController::class, 'scan'])->name('presence.scan');
});
route::group(['middleware' => 'role:Admin'],function(){
    Route::get('/create/student', [App\Http\Controllers\PresencesController::class, 'create'])->name('presence.create');
    Route::get('/edit/student/{id}', [App\Http\Controllers\PresencesController::class, 'edit'])->name('presence.edit');
    Route::post('/store/student', [App\Http\Controllers\PresencesController::class, 'store'])->name('presence.store');
    Route::patch('/update/student/{id}', [App\Http\Controllers\PresencesController::class, 'update'])->name('presence.update');
    Route::get('/index/grade', [App\Http\Controllers\GradeController::class, 'index'])->name('grade.index');
    Route::get('/create/grade', [App\Http\Controllers\GradeController::class, 'create'])->name('grade.create');
    Route::post('/store/grade', [App\Http\Controllers\GradeController::class, 'store'])->name('grade.store');
    Route::get('/edit/grade/{id}', [App\Http\Controllers\GradeController::class, 'edit'])->name('grade.edit');
    Route::patch('/update/grade/{id}', [App\Http\Controllers\GradeController::class, 'update'])->name('grade.update');
    Route::patch('/unblock/{id}',[App\Http\Controllers\PresencesController::class,'unblock'])->name('presence.unblock');
    Route::delete('/delete/grade/{id}', [App\Http\Controllers\GradeController::class, 'delete'])->name('grade.delete');
    route::group(['prefix' => 'monitor'],function(){
        Route::get('/monitor', [MonitorController::class, 'monitor'])->name('monitor');
        route::get('/students',[MonitorController::class,'students'])->name('monitor.students');
        route::get('/show/{id}',[MonitorController::class,'show'])->name('monitor.show');
        route::get('/grade/{id}',[MonitorController::class,'grade'])->name('monitor.grade');
    });
    route::group(['prefix' => 'report'],function(){
        route::get('/index/{dT}',[ReportController::class,'index'])->name('report.index');
        route::get('/kelas/{id}/{dT}',[ReportController::class,'kelas'])->name('report.kelas');
        route::get('/siswa/{id}',[ReportController::class,'siswa'])->name('report.siswa');
    });
});

Route::get('/', function(){
    return redirect()->route('presence');
});