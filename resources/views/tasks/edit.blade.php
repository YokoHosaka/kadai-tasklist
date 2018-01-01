@extends('layouts.app')
@section('content')

    <h1>id: {{ $task->id }} のタスク編集ページ</h1>
    
    {!! Form::model($task, ['route' => ['tasks,update', $task->id], 'method' => 'put' ]) !!}
    
        {!! Form::lable('content', 'タスク：') !!}
        {!! Form::text('content') !!}
    
        {!! Form::submit('更新する') !!}
        
    {!! Form::close() !!}
    
@endsection