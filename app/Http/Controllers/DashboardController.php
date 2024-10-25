<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $ijins = Ijin::all();
        // dd($ijins);
        return view('dashboard', compact('ijins'));
    }
}
