<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class TasksController extends Controller {

	protected $rules = [
		'name' => ['required', 'min:3'],
		'slug' => ['required'],
		'description' => ['required']
	];

	/**
	 * Display a listing of the resource.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function index()
	{
        $tasks = Task::all();
		return view('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function create()
	{
        //$projects = DB::table('projects')->get();
        // DB::table() returns array
        $projects = Project::get(); // returns a collection
        $projectNameAndId = array();
        foreach ($projects as $project) {
            $projectNameAndId[$project->id] = $project->name;
        }
		return view('tasks.create', array('projectNameAndId' => $projectNameAndId));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Project $project
	 * @param \Illuminate\Http\Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		$input = Input::all();
		Task::create( $input );

		return Redirect::route('dashboard.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Project $project
	 * @param  \App\Task    $task
	 * @return Response
	 */
	public function show(Project $project, Task $task)
	{
		return view('tasks.show', compact('project', 'task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Project $project
	 * @param  \App\Task    $task
	 * @return Response
	 */
	public function edit(Project $project, Task $task)
	{
        $projects = Project::get(); // returns a collection
        $projectNameAndId = array();
        foreach ($projects as $project) {
            $projectNameAndId[$project->id] = $project->name;
        }
		return view('tasks.edit', compact('project', 'task', 'projectNameAndId'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Project $project
	 * @param  \App\Task    $task
	 * @param \Illuminate\Http\Request $request
	 * @return Response
	 */
	public function update(Project $project, Task $task, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), '_method');
		$task->update($input);

		return Redirect::route('projects.tasks.show', [$project->slug, $task->slug])->with('message', 'Task updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Project $project
	 * @param  \App\Task    $task
	 * @return Response
	 */
	public function destroy(Project $project, Task $task)
	{
		$task->delete();

		return Redirect::route('projects.show', $project->slug)->with('message', 'Task deleted.');
	}

}
