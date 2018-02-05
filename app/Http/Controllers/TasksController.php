<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        
        if(\Auth::check()){
            
            $user = \Auth::user();
            $tasks = $user->tasks()->get();
            //$taskの内容はstatusとcontentであるが、それはTaskモデル(Task.php)定義している。
            // $task = $user->tasks() の記述は ->get()を入れないとユーザにタスクを紐づけただけなのでデータを表示するために取ってくる必要あり
        
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                ];
            }
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::check()){
                
            $user = \Auth::user();
            $tasks = new Task;
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                ];
        }
        
        return view('tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:255',
            ]);
        
           
           $request->user()->tasks()->create([
               'content' => $request->content,
               'status' => $request->status,
           ]);
            
            return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $task =Task::find($id);
        //表示するtaskは一つなので単数形
        
        $data = [];
     
        if (\Auth::user()->id == $task->user_id){
            //ログインしたユーザーのタスクのみ表示する
        
            $data = [
            'user' => $user, 
            'task' => $task,
            ];
        
            return view('tasks.show', $data);
            //if節がtrueの時のみ表示し、falseならば表示されない
        
            }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        $task =Task::find($id);
        //編集するtaskは一つなので単数形
        
        if (\Auth::user()->id === $task->user_id){
            //ログインしたユーザーのタスクのみ編集する 
            //== は値が同じであればよい。===は型まで同じであることが求められる。
            
            $data = [
                'user' => $user,
                'task' => $task,
            ];
             return view('tasks.edit', $data); 
        }    
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::user()->id === $task->user_id){
            //== は値が同じであればよい。===は型まで同じであることが求められる。
                $task->delete();
        }   
        
        return redirect('/');
    }
}