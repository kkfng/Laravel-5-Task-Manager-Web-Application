@extends('app')

@section('content')
    <h2>Create Task</h2>

    {!! Form::model(new App\Task, ['route' => ['projects.tasks.store'], 'class'=>'']) !!}
        @include('tasks/partials/_form', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@endsection