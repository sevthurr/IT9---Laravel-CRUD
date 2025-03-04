<!-- resources/views/tasks/partials/task-table.blade.php -->
<table class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Description</th>
            <th>Created At</th>
            <th style="width: 100px;">Actions</th>
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
                <td style="white-space: nowrap;">
                    <a href="{{ route('tasks.edit', $task->id) }}" 
                       style="display: inline-block; margin-right: 8px;" 
                       class="custom-btn custom-btn-warning btn-sm"
                       hx-get="{{ route('tasks.edit', $task->id) }}"
                       hx-target="#tasks-table"
                       hx-swap="outerHTML">
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
