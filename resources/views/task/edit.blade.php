@extends('adminlte::page')

@section('title','タスク編集')

@section('content')

<x-task-validation-errors class="mb-4" :errors="$errors" />

{{ Form::model($task,['method'=>'put', 'route'=>['task.update',$task->id]]) }}
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        {{ Form::label('title','タイトル')}}
        {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'タイトル']) }}
      </div>
      <div class="form-group">
        {{ Form::label('content','コンテンツ')}}
        {{ Form::textarea('content',null,['class'=>'form-control','placeholder'=>'コンテンツ']) }}
      </div>
      <div class="form-group">
        {{ Form::label('status','未対応')}}
        {{ Form::radio('status', '1') }}
        {{ Form::label('status','対応済み')}}
        {{ Form::radio('status', '2') }}
      </div>
      <div class="form-group">
        {{Form::label('date','期限',['class' => 'col-md-2 col-form-label text-left'])}}
        {{ Form::date('deadline', null, ['class'=>'col-md-5 form-control']) }}
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <a class="btn btn-default" href="{{ route('task.index') }}" role="button">戻る</a>
          <div class="ml-auto">
            {{ Form::submit('更新', ['class' => 'btn btn-primary btn-block']) }}
          </div>
            {{ Form::close() }}

         <div class="ml-md-3">
          <form action="{{ route('task.destroy', $task->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('削除してもよろしいですか？');">削除</button>
          </form>
      </div>
    </div>
  </div>
  </div>


          </div>

@stop

