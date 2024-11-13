<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use App\Models\Whacenter;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalSatpam = User::role('satpam')->count();
        $totalUsers = User::count(); // Total semua pengguna
        $totalTeachers = User::role('guru')->count();
        $totalParents = User::role('orangtua')->count();
        $whacenter = Whacenter::where('default', 1)->first();
        $totalWhacenter = Whacenter::count();
        $totalRole = Role::count();
        $totalPermission = Permission::count();

        $totalStudentsWentHome = Ijin::where('status', 'picked_up')->count();

        $totalIzinWaiting = Ijin::where('status', 'wait_approval')->count();
        $totalIzinApproved = Ijin::where('status', 'approved')->count();
        $totalIzinRejected = Ijin::where('status', 'rejected')->count();
        $totalIzinDone = Ijin::where('status', 'returned')->count();

        // dd($whacenter);
        $users = User::all();

        return view('admin.index', compact('whacenter', 'totalStudents', 'totalSatpam', 'totalUsers', 'totalTeachers', 'users', 'totalParents', 'totalWhacenter', 'totalRole', 'totalPermission', 'totalStudentsWentHome', 'totalIzinWaiting', 'totalIzinApproved', 'totalIzinRejected', 'totalIzinDone'));
    }

    public function studentIndex()
    {
        $students = Student::all();

        return view('admin.student.index', compact('students'));
    }

    public function studentCreate()
    {
        $classes = StudentClass::all();

        return view('admin.student.create', compact('classes'));
    }

    public function studentStore(Request $request)
    {

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

    public function studentShow(Student $student)
    {
        return view('admin.student.show', compact('student'));
    }

    public function studentEdit(Student $student)
    {
        $classes = StudentClass::all();
        return view('admin.student.edit', compact('student', 'classes'));
    }

    public function studentUpdate(Request $request, Student $student)
    {

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

    public function studentDestroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.student.index');
    }


    public function userIndex()
    {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    public function userShow(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function userEdit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, User $user)
    {
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

    public function userDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.index');
    }

    public function roleIndex()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.role.index', compact('roles', 'permissions'));
    }

    public function roleShow(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.show', compact('role', 'permissions'));
    }

    public function roleCreate()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function roleStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.index');
    }

    public function roleEdit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function roleUpdate(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.index');
    }


    public function roleDestroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.role.index');
    }


    public function permissionCreate()
    {
        return view('admin.permission.create');
    }

    public function permissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.role.index');
    }

    public function permissionEdit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function permissionUpdate(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.role.index');
    }

    public function permissionDestroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.role.index');
    }
}
