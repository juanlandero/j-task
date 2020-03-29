<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(){

        $objUsuario = Auth::user()->name . " " . Auth::user()->first_name;

        return view('student_dashboard.index', ['usuario' => $objUsuario]);
    }

    public function task(){
        return view('student_dashboard.tarea');
    }
}
