<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;

class MonitorController extends Controller
{
    public function monitor(){
        return view ('presence.monitor.index');
    }

    public function students(){
        $students = Student::with('grade','presences')->get();
        return view('presence.monitor.students',compact('students'));
    }

    public function show($id){
        $student = Student::with('grade','presences')->findOrFail($id);
        return view('presence.monitor.show',compact('student','dT'));
    }

    public function grade($id){
        $grade = Grade::findOrFail($id);
        $students = Student::with('grade','presences')->where('grade_id',$id)->get();
        return view('presence.monitor.grades',compact('grade','students'));
    }
}
