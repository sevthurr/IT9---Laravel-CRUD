<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
      //display a listing of the tasks.
     
    public function index()
    {
        // get all tasks from the database
        $tasks = Task::all();

        // pass tasks to the index view
        return view('tasks.index', compact('tasks'));
    }

    
      //form for creating a new task.
     
    public function create()
    {
        // return the create view
        return view('tasks.create');
    }

    
      //Store a newly created task in storage.
     
    public function store(Request $request)
    {
        // validate input
        // status must be one of the enum values
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        // create and save the task
        Task::create($request->all());
        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully!');
    }

    
     //Display the specified task.
     
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    //edit task form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    //update task function
    public function update(Request $request, Task $task)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

 
        $task->update($request->all());

        // redirect to the index with a success message
        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully!');
    }

    //delete task function
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully!');
    }
}
