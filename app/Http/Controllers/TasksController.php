<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,TaskService $taskService)
    {
        
        $tasks = $taskService->getTasks($request);
        
        return view('task.index')
            ->with([
                'tasks' => $tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task;
        $task->user_email = Auth::id();
        $task->fill($request->all())->save();
        return redirect()->route('task.index')->with('message','タスクを作成しました');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($taskId,TaskService $taskService)
    {
        
        if(!$taskService->checkOwnTask($taskId)){
            throw new AccessDeniedHttpException();
        }
        // $task = Task::find($taskId)->firstOrFail();

        return view('task.edit',[
            'task' => Task::find($taskId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$taskId,TaskService $taskService)
    {
        if(!$taskService->checkOwnTask($taskId)){
            throw new AccessDeniedHttpException();
        }
        $task = Task::where('id', $taskId)->firstOrFail();
        $task->fill($request->all())->save();

        return redirect()->route('task.index')->with('message','タスクを編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskId,TaskService $taskService)
    {
        if(!$taskService->checkOwnTask($taskId)){
            throw new AccessDeniedHttpException();
        }
        task::where('id',$taskId)->delete();

        return redirect()->route('task.index')->with('message','タスクを削除しました');
    }
}
