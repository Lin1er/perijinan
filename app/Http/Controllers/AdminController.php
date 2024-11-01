<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function studentIndex(){
        $students = Student::all();

        dd($students);

        return view('admin.student.index', compact('students'));
    }

    public function studentCreate(){
        return view('admin.student.create');
    }

    public function studentStore(Request $request){
        $request->validate([
            'name' => 'required',
            'nis' => 'required',
            'class' => 'required',
            'address' => 'required',
        ]);

        Student::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'class' => $request->class,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.student.index');
    }

    public function studentShow(Student $student){
        return view('admin.student.show', compact('student'));
    }

    public function studentEdit(Student $student){
        return view('admin.student.edit', compact('student'));
    }

    public function studentDestroy(Student $student){
        $student->delete();

        return redirect()->route('admin.student.index');
    }
}
