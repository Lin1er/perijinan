<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(){
        $totalStudents = Student::count();
        $totalSatpam = User::role('satpam')->count();
        $totalUsers = User::count(); // Total semua pengguna
        $totalTeachers = User::role('guru')->count();
        $totalParents = User::role('orangtua')->count();
        $users = User::all();

        return view('admin.index', compact('totalStudents', 'totalSatpam', 'totalUsers', 'totalTeachers', 'users', 'totalParents'));
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
            'username' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        Student::create([
            'student_class_id' => $request->student_class_id,
            'username' => $request->username,
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'born_date' => $request->born_date
        ]);

        return redirect()->route('admin.student.index');
    }

    public function studentShow(Student $student){
        return view('admin.student.show', compact('student'));
    }

    public function studentEdit(Student $student){
        $classes = StudentClass::all();
        return view('admin.student.edit', compact('student', 'classes'));
    }

    public function studentUpdate(Request $request, Student $student){

        $student->update([
            'student_class_id' => $request->student_class_id,
            'username' => $request->username,
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'born_date' => $request->born_date
        ]);
        
        return redirect()->route('admin.student.index');
    }

    public function studentDestroy(Student $student){
        $student->delete();
        
        return redirect()->route('admin.student.index');
    }

    
    public function userIndex(){
        $users = User::all();
        
        return view('admin.index', compact('users'));
    }
    
    public function userShow(User $user){
        return view('admin.user.show', compact('user'));
    }
    
    public function userEdit(User $user){
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, User $user){
        $request->validate([
            'name' => 'required',
        ]);
        
        $user->update([
            'name' => $request->name,
            
        ]);
        
        $user->syncRoles($request->roles);
        
        return redirect()->route('admin.index');
    }

    public function kelasIndex()
    {
        return view('admin.kelas.index');
    }

    public function userDestroy(User $user){
        $user->delete();

        return redirect()->route('admin.index');
    }
}
