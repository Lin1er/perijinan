<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function studentIndex(){
        $students = Student::all();

        return view('admin.student.index', compact('students'));
    }

    public function studentCreate(){
        $classes = StudentClass::all();

        return view('admin.student.create', compact('classes'));
    }

    public function studentStore(Request $request){

        // dd($request->all());

        $request->validate([
            'student_class_id' => 'required',
            'name' => 'required',
            'username' => 'required'
        ]);

        Student::create([
            'student_class_id' => $request->student_class_id,
            'username' => $request->username,
            'name' => $request->name,
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
