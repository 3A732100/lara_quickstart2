<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request){
        return view('tasks.index');
    }
    public function __construct()
    {
        $this->middleware('auth');//讓有經過驗證的使用者才能存取
    }
}
