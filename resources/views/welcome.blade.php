@extends('app')


@section('styles')
    <style>
        #welcome-box {
            margin-top: 100px;
        }
    </style>
@endsection

@section('content')   
    <div id="welcome-box" class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kelvin Ng
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <p class="lead">WEB306 Assignment: Task Manager</p>
                        <a href="{{ url('dashboard') }}" class="btn btn-primary btn-lg">Dashboard</a>
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection