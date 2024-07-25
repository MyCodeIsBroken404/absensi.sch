<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Presence;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresencesController extends Controller
{
    public function index(){
        $timezone = 'Asia/Jakarta';
        $today = Carbon::now()->setTimezone($timezone)->format('Y-m-d');
        $students = Student::with(['grade','presences' => function($query) use ($today){
            $query->whereDate('created_at',$today);
        }])->get();
        $curr_student = null;
        $s_id = request()->session()->get('message');
        if($s_id){
            $curr_student = Student::with(['grade','presences' => function($query) use ($today){
                return $query->whereDate('created_at',$today);
            }])->findOrFail($s_id);
        }
        return view ('presence.index',compact('students','today','curr_student'));
    }
    
    public function scan(Request $request){
        $request->validate([
            'rfid' => 'required',
        ]);
        $rfid = $request->rfid;
        $student = Student::with('presences')->where('rfid',$rfid)->first();
        if(!$student){
            return redirect()->route('presence')->with('message',null);
        }
        $today = Carbon::today()->setTimezone('Asia/Jakarta')->toDateString();
        $todaysPresence = $student->presences()->whereDate('created_at',$today)->exists();
        if($todaysPresence){
            return redirect()->route('presence')->with('message',$student->id);
        }

        Presence::create([
            'student_id' => $student->id,
        ]);
        return redirect()->route('presence')->with('message',$student->id);

    }

    public function unblock(Request $request,$id){
        $presences = Presence::where('student_id',$id)->where('attempts',0)->get()                                                                                                                                                                                                                                                                                                                                                                      ;
        foreach($presences as $presence){
            $presence->attempts = 3;
            $presence->update();
        }
        return redirect()->route('presence');
    }

    public function create(){
        $grades = Grade::all();
        return view ('presence.create',compact('grades'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|file|image|max:16384|mimes:jpg,png,jpeg,svg,gif',
            'grade_id' => 'required',
            'rfid' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
        ]);
        $img = $request->file('image');
        $imgName = time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('/images'),$imgName);

        Student::create([
            'name' => $request->name,
            'image' => $imgName,
            'grade_id' => $request->grade_id,
            'rfid' => $request->rfid,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
        ]);
        return redirect()->route('presence');
    }

    public function edit($id){
        $student = Student::findOrFail($id);
        $grades = Grade::all();
        return view('presence.edit', compact('student', 'grades'));
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required',
            'image' => 'required|file|image|max:16384|mimes:jpg,png,jpeg,svg,gif',
            'grade_id' => 'required',
            'rfid' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',          
        ]);
        $student = Student::findOrFail($id);
    
        $img = $request->file('image');
        $imgName = time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('/images'),$imgName);

        $student->update([
            'name' => $request->name,
            'image' => $imgName,
            'grade_id' => $request->grade_id,
            'rfid' => $request->rfid,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
        ]);
        return redirect()->route('presence');
    }

    public function delete(Request $request, $id){
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('presence');
       
    }
    
    
}