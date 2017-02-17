<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        
        $projects = Project::get(); // get() - gets a collection of objects
        $tasks = Task::get();
            
            
        // check your variable;
//        dd($heroes);
        
        return view('dashboard.index', compact('projects', 'tasks'));
    }
}













