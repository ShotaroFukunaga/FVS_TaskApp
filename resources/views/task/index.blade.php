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

  <div class="table table-striped table-hover">
    <table class="table-responsive table-bordered" style="width: auto; max-width: 0 auto;">
      <tr class="table-info">
        <th scope="col" width="20%">ユーザーID</th>
        <th scope="col" width="20%">タスク</th>
        <th scope="col" width="20%">期日</th>
        <th scope="col" width="30%">内容</th>
        <th scope="col" width="10"></th>
      </tr>
      @foreach($tasks as $task)
      <tr>
        <th scope="row">{{$task->user_email}}</th>
        <th scope="row">{{$task->title}}</th>
        <th scope="row">{{$task->deadline?->format('Y/m/d') ?? ''}}</th>
        <th scope="row">{{$task->content}}</th>
        <th>
        <button class="btn btn-success m-1 btn-sm" href="{{ route('task.edit', $task->id) }}">詳細</button>
        </th>
      </tr>
      @endforeach
    </table>
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