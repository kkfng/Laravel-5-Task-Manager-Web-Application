@extends('app')


@section('styles')
    <style>
        #main-nav {
            margin-bottom: 10px;
        }
        
        .delete-btn {
            position: absolute;
            right: 30px;
            top: 10px;
        }
        
    </style>
@endsection

@section('content')
  
    <h1 class="text-center">Task Manager</h1>
    <div id="main-nav" class="text-center">
        <a href="{{ url('add-project') }}" class="btn btn-primary">Add Project</a>
        <a href="{{ url('add-task') }}" class="btn btn-danger">Add Task</a>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Projects
                </div>
                @if ( !$projects->count() )
                    You have no projects
                @else
                    <ul class="list-group">
                        @foreach( $projects as $eachProject )
                            <li class="list-group-item">
                                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $eachProject->slug))) !!}
                                    <a href="{{ route('projects.show', $eachProject->slug) }}">{{ $eachProject->name }}</a>
                                    <div class="positionRight">
                                        {!! link_to_route('projects.edit', 'Edit', array($eachProject->slug), array('class' => 'btn btn-info')) !!},
                                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                    </div>
                                {!! Form::close() !!}
                            </li>
                        @endforeach    
                    </ul>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Tasks
                </div>
                @if ( !$tasks->count() )
                    You have no tasks
                @else
                    @foreach( $projects as $project )
                        @foreach( $project->tasks as $task )
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasks.destroy', $project->slug, $task->slug))) !!}
                                        <a href="{{ route('projects.tasks.show', [$project->slug, $task->slug]) }}">{{ $task->name }}</a>
                                        <div class="positionRight">
                                            {!! link_to_route('projects.tasks.edit', 'Edit', array($project->slug, $task->slug), array('class' => 'btn btn-info')) !!},
                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        @endforeach
                    @endforeach            
                @endif
            </div>
        </div>
    </div>
    
@endsection