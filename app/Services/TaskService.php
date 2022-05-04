<?php

namespace App\Services;

use App\Models\task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService
{


  
  public function getTasks($request)
  {
    $query = Task::query();
    
    if($search = $request->input('search')){
    $this->searchTask($search,$query);
    }
    elseif($request->input('due')){
    $this->dueTask($request,$query);
    }
    else{
      $this->statusTask($request,$query);
    }
    
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
    return $query->where('status', $status);
  }

  public function dueTask($request,$query)
  {
    
      return $query->where('deadline','<',Carbon::now());
    
  }

  public function searchTask($search,$query)
  {
      $convert_space = mb_convert_kana($search, 's');
      $wordSearched = preg_split('/[\s,]+/',$convert_space, -1, PREG_SPLIT_NO_EMPTY);
     
      foreach($wordSearched as $value){
        $query->where('title','like','%'.$value.'%');
      }
    
  }


  public function checkOwnTask(int $userId, int $taskId): bool
  {
    $task = Task::where('id',$taskId)->first();
    if(!$task){
      return false;
    }
    return $task->user_id === $userId;
  }

}