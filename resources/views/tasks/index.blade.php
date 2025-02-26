<!-- resources/views/tasks/index.blade.php -->
<x-app-layout>
    <style>
        .custom-container {
            margin: 50px auto;
            max-width: 1200px;
        }
        .custom-heading {
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .custom-alert {
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            color: #155724;
            margin-bottom: 20px;
        }
        .custom-btn {
            padding: .375rem .75rem;
            border: none;
            border-radius: .25rem;
            text-decoration: none;
            cursor: pointer;
        }
        .custom-btn-primary {
            background-color: #007bff;
            color: white;
        }
        .custom-btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .custom-btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .custom-table th, 
        .custom-table td {
            padding: .75rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .custom-table th {
            background-color: #343a40;
            color: white;
        }
        .text-center {
            text-align: center;
        }
    </style>

    <div class="custom-container">
        <h1 class="custom-heading">TaskMaster</h1>


        @if (session('success'))
            <div class="custom-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('tasks.create') }}" class="custom-btn custom-btn-primary">
                Create New Task
            </a>
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td style="width: 150px; white-space: nowrap;">
                            <a href="{{ route('tasks.edit', $task->id) }}" 
                               style="display: inline-block; margin-right: 8px;" 
                               class="custom-btn custom-btn-warning btn-sm">
                                Edit
                            </a>
                        
                            <form action="{{ route('tasks.destroy', $task->id) }}" 
                                  method="POST" 
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="custom-btn custom-btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this task?');">
                                    Delete
                                </button>
                            </form>
                        </td>                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
