<?php

namespace App\Services;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService
{

  //条件にマッチしたタスクを取得
  public function getTasks($request)
  {
    $query = Task::query();

    $this->searchTask($request,$query);
    
    $this->deadlineTask($request,$query);
    
    $this->statusTask($request,$query);

    return $query->where('user_email', Auth::id())
                  ->orderBy('created_at','DESC')
                  ->paginate(5);

  }

  //ステータスのタスクを取得
  public function statusTask($request,$query)
  {
    $status = 1;
    if(isset($request['cmp'])){
      $status = 2;
    }
    return $query->where('status', $status);
  }

  //現時刻から期限が超過したタスクを取得
  public function deadlineTask($request,$query)
  {
    if(isset($request['due'])){
      $carbon = Carbon::now();
      return $query->where('deadline','<',$carbon->subDays(1));
    }
    return null;
  }

  //タスクをあいまい検索
  public function searchTask($request,$query)
  {
    if($search = $request->input('search')){
      $convert_space = mb_convert_kana($search, 's');
      $wordSearched = preg_split('/[\s,]+/',$convert_space, -1, PREG_SPLIT_NO_EMPTY);
      foreach($wordSearched as $value){
        return $query->where('title','like','%'.$value.'%');
      }
    }
    return null;
  }

  // public function SaveRequest(TaskRequest $request,$instance){
  //   return $instance->fill($request->all())->save();
  // }

  //タスクとユーザーが一致するかチェック
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