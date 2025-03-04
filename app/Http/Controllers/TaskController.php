<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $filter = 'all';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'));
        }

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in-progress,completed',
        ]);

        Task::create($request->all());
        $tasks = Task::all();
        $filter = 'all';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'))
                   ->with('success', 'Task created successfully!');
        }

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,in-progress,completed',
        ]);

        $task->update($request->all());
        $tasks = Task::all();
        $filter = 'all';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'))
                   ->with('success', 'Task updated successfully!');
        }

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        $tasks = Task::all();
        $filter = 'all';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'))
                   ->with('success', 'Task deleted successfully!');
        }

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully!');
    }

    public function completed()
    {
        $tasks = Task::where('status', 'completed')->get();
        $filter = 'completed';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'));
        }

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function inProgress()
    {
        $tasks = Task::where('status', 'in-progress')->get();
        $filter = 'in-progress';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'));
        }

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function pending()
    {
        $tasks = Task::where('status', 'pending')->get();
        $filter = 'pending';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'));
        }

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function deleted()
    {
        $tasks = Task::onlyTrashed()->get();
        $filter = 'deleted';

        if (request()->header('HX-Request')) {
            return view('tasks.partials.task-table', compact('tasks', 'filter'));
        }

        return view('tasks.index', compact('tasks', 'filter'));
    }
}
