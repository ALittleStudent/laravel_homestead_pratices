<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

use App\Tasks;
use App\User;

class TaskController extends Controller
{

    protected $tasks;
    
    public function __construct(TaskRepository $tasks){
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request){
        $tasks = Tasks::where('user_id', $request->user()->id)->get();
         return view('tasks', [
        'tasks' =>  $this->tasks->forUser($request->user()),
    ]);
    }

    public function store(Request $request){
    $this->validate($request, [
        'name' => 'required|max:255',
    ]);

    // Create The Task...
    $request->user()->tasks()->create([
        'name' => $request->name,
    ]);

    return redirect('/tasks');
}

    public function destroy(Request $request, Tasks $task){
    
    $this->authorize('destroy', $task);
    $task->delete();
    return redirect('/tasks');
}
}
