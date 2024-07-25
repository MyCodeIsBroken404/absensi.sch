<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index($dT){
        $students = Student::with(['grade','presences' => function($query) use ($dT){
            $query->whereDate('created_at',$dT);
        }])->get();
        $pdf = Pdf::loadView('report.index',compact('students','dT'));
        return $pdf->stream($dT.'_data_siswa.pdf');
    }

    public function kelas($id,$dT){
        $grade = Grade::findOrFail($id);
        $students = Student::with(['grade','presences' => function($query) use ($dT){
            $query->whereDate('created_at',$dT);
        }])->where('grade_id',$id)->get();
        $pdf = Pdf::loadView('report.kelas',compact('students','dT','grade'));
        return $pdf->stream($dT.'_data_siswa.pdf');
    }

    public function siswa($id){
        $dT = Carbon::today()->toDateString();
        $student = Student::with('grade','presences')->findOrFail($id);
        $pdf = Pdf::loadView('report.siswa',compact('student','dT'));
        return $pdf->stream($dT.'_data_siswa.pdf');
    }
}
