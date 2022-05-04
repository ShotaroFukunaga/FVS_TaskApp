<?php

namespace App\Services;

use App\Models\task;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService
{

  public function getTasks($request)
  {
    $query = Task::query();

    $this->searchTask($request,$query);
    
    $this->dueTask($request,$query);
    
    $this->statusTask($request,$query);

    
    return $query->where('user_email', Auth::id())
                  ->orderBy('created_at','DESC')
                  ->paginate(5);

  }

  public function statusTask($request,$query)
  { 
    $status = 1;

    if($request->input('cmp')){
      $status = 2;
    }
    return $status = $query->where('status', $status);
  }

  public function dueTask($request,$query)
  {
    
    if($request->input('due')){
      $query->where('deadline','<',Carbon::now());
    }
    
  }

  public function searchTask($request,$query)
  {
    if($search = $request->input('search')){
      $convert_space = mb_convert_kana($search, 's');
      $wordSearched = preg_split('/[\s,]+/',$convert_space, -1, PREG_SPLIT_NO_EMPTY);
      foreach($wordSearched as $value){
        return $query->where('title','like','%'.$value.'%');
      }
    }
  }

  public function saveTask($task,$request){
    $task->fill($request->all())->save();
    return 0;
  }


  public function checkOwnTask(int $taskId): bool
  {
    $user_id = Auth::id();
    $task = Task::where('id',$taskId)->first();
    if(!$task){
      return false;
    }
    return $task->user_email === $user_id;
  }

}