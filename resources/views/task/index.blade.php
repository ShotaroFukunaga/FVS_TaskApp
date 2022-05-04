@extends('adminlte::page')

@section('title', 'Tasks')

@section('content_header')
    <h1>Tasks</h1>
@stop

@auth
@section('content')

<x-task-validation-errors class="mb-4" :errors="$errors" />

@if(session('message'))
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
      x
    </button>
    {{session('message')}}
  </div>
@endif

<form class="row g-4" method="GET" action="{{ route('task.index') }}">
  <div class="col-auto">
    <input class="form-control mt-1" type="text" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
  </div>
  <div class="col-auto">
  <button class="btn btn-dark m-1 btn-sm" type="submit">検索</button>
  </div>
</form>
<form class="block mb-2 mt-4" method="GET" action="{{ route('task.index') }}">
<button class="btn btn-success m-1 btn-sm" type="submit" name="cmp" value="1">完了済みタスク</button>
<button class="btn btn-danger m-1 btn-sm" type="submit" name="due" value="due">期限超過</button>
<button class="btn btn-secondary m-1 btn-sm" type="submit">クリア</button>

<a class="btn btn-info ml-5 btn-sm" href="{{ route('task.create') }}" role="button">タスク追加</a>
</form>



  <div class="table-responsive">
    <table class="table" style="width: 1300px; max-width: 0 auto;">
      <tr class="table-info">
        <th scope="col" width="30%" height="20%">ユーザーID</th>
        <th scope="col" width="40%">タスク</th>
        <th scope="col" width="30%">期日</th>
      </tr>
      @foreach($tasks as $task)
      <tr>
        <th scope="row">{{$task->user_email}}</th>
        <th scope="row"><a href="{{ route('task.edit', $task->id) }}">{{$task->title}}</a></th>
        <th scope="row">{{$task->deadline?->format('Y/m/d') ?? ''}}</th>
      </tr>
      @endforeach
    </table>

    @if(!$tasks)
      <div class="d-flex justify-content-center">
        <h3>タスクがありません</h3>
      </div>
    @endif

  </div>
@stop
@endauth

@section('footer')
  <div class="d-flex justify-content-center">
    {{ $tasks->appends(request()->input())->links() }}
  </div> 
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop