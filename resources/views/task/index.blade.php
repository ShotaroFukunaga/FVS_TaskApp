@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tasks</h1>
@stop

@auth
@section('content')
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
          <th scope="row">{{$task->title}}</th>
          <th scope="row">{{$task->deadline?->format('Y/m/d') ?? ''}}</th>
      </tr>
      @endforeach
    </table>

    @if($tasks !== null)
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