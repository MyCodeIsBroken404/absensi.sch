<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(){
        $grades = Grade::with('students')->get();
        return view('presence.grade.index',compact('grades'));
    }

    public function create(){
        return view('presence.grade.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
        ]);
        Grade::create($request->all());
        return redirect()->route('grade.index');
    }

    public function edit($id){
        $grade = Grade::findOrFail($id);
        return view('presence.grade.edit',compact('grade'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
        ]);
        $grade = Grade::findOrFail($id);
        $grade->update($request->all());
        return redirect()->route('grade.index');
    }

    public function delete(Request $request,$id){
        $grade = Grade::findOrFail($id);
        $grade->delete();
        return redirect()->route('grade.index');
    }
}