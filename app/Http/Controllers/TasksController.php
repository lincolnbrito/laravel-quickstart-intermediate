<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\TaskRepository;

class TasksController extends Controller
{

    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        //$tasks = $request->user()->tasks()->get();
        $tasks = $this->tasks->forUser($request->user());
        return view('tasks.index',['tasks'=>$tasks]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name
        ]);

        return redirect('/tasks');
    }
}
