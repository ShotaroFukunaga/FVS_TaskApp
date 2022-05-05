@extends('adminlte::page')

@section('title', 'Tasks')

@section('content_header')
    <h1>Tasks</h1>
    <form class="row g-4" method="GET" action="{{ route('task.index') }}">
  @csrf
  <div class="col-auto">
    <input class="form-control mt-1" type="text" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
  </div>
  <div class="col-auto">
    <button class="btn btn-dark m-1 btn-sm" type="submit">検索</button>
  </div>
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




<form class="block mb-2 mt-4" method="GET" action="{{ route('task.index') }}">
  @csrf
  <button class="btn btn-success m-1 btn-sm" type="submit" name="cmp" value="1">完了済みタスク</button>
  <button class="btn btn-danger m-1 btn-sm" type="submit" name="due" value="due">期限超過</button>
  <a class="btn btn-info mr-5 btn-sm" href="{{ route('task.create') }}" role="button">タスク追加</a>
</form>

  
    <table class="table table-bordered table-hover">
    <thead>
      <tr class="table-info">
        <th>タイトル</th>
        <th>内容</th>
        <th>期日</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td>
        <p>{{$task->title}}</p>
        <p>{{$task->user_email}}</p>
        </td>
        <td>{{$task->deadline?->format('Y/m/d') ?? ''}}</td>
        <td>{{$task->content}}</td>
        <td>
        <button class="btn btn-success btn-sm" href="{{ route('task.edit', $task->id) }}">詳細</button>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
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