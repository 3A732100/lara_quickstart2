<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request){
        return view('tasks.index');//回傳tasks.index視圖
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',//寫入時,驗證資料是否非空白,且字數不可大於255字元
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');//讓有經過驗證的使用者才能存取
    }
}
