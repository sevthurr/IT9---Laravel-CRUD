<!-- resources/views/tasks/edit.blade.php -->
<x-app-layout>
    <style>
       
        .custom-container {
            margin: 50px auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .custom-heading {
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
        }
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
        }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0069d9;
        }
    </style>

    <div class="custom-container">
        <h1 class="custom-heading">Edit Task</h1>

       
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="in-progress" {{ old('status', $task->status) === 'in-progress' ? 'selected' : '' }}>
                        In-Progress
                    </option>
                    <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description (optional):</label>
                <textarea name="description" id="description" rows="4">{{ old('description', $task->description) }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Update Task</button>
        </form>
    </div>
</x-app-layout>
