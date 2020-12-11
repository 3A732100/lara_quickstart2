<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index(Request $request){
        $tasks = Task::where('user_id', $request->user()->id)->get();
        //或$tasks= auth()->user()->tasks;
        //$tasks= auth()->user()->tasks()->get();
        //$tasks=Auth::user()->tasks;
        //$tasks=Auth::user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,//回傳tasks.index視圖,並顯示送出request的使用者的所有tasks
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',//寫入時,驗證資料是否非空白,且字數不可大於255字元
        ]);

        $request->user()->tasks()->create([//從送出request的人的User model找到其Task model,對tasks資料表進行create的動作
            'name' => $request->name,//*送出request的人所輸入的name會被寫入tasks資料表的name
        ]);
        //$request->user()->tasks()->create( $request->all() ); $request->all()是將送出request的人所輸入的所有資料,寫入tasks資料表對應欄位
        //auth()->user()->tasks()->create( $request->all() ); $request->user()=auth()->user()=Auth:: user()
        return redirect('/tasks');//跳轉至/tasks(tasks.index)

    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);//授權行為
    }

    public function __construct()
    {
        $this->middleware('auth');//讓有經過驗證的使用者才能存取
    }
}
