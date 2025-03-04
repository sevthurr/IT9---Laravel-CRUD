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
        .custom-btn-success {
            background-color: #28a745;
            color: white;
        }
        .custom-btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .custom-table {
            width: 110%;
            border-collapse: collapse;
            margin-top:40px;
            margin-left: 0px;
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

    <script src="https://unpkg.com/htmx.org@1.9.2"></script>

    <div id="tasks-container" class="custom-container">
        <h1 class="custom-heading";>TaskMaster</h1>

        @if (session('success'))
            <div class="custom-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('tasks.index') }}" 
               class="custom-btn custom-btn-primary me-2"
               style="background-color: grey; margin-left: 10px;"
               hx-get="{{ route('tasks.index') }}"
               hx-target="#tasks-table"
               hx-swap="innerHTML">
                All Tasks
            </a>
            <a href="{{ route('tasks.completed') }}" 
               class="custom-btn custom-btn-success me-2"
               style="margin-left: 10px;"
               hx-get="{{ route('tasks.completed') }}"
               hx-target="#tasks-table"
               hx-swap="innerHTML">
                Completed
            </a>
            <a href="{{ route('tasks.inProgress') }}" 
               class="custom-btn custom-btn-warning me-2"
               style="margin-left: 10px;"
               hx-get="{{ route('tasks.inProgress') }}"
               hx-target="#tasks-table"
               hx-swap="innerHTML">
                In Progress
            </a>
            <a href="{{ route('tasks.pending') }}" 
               class="custom-btn custom-btn-info me-2"
               style="margin-left: 10px;"
               hx-get="{{ route('tasks.pending') }}"
               hx-target="#tasks-table"
               hx-swap="innerHTML">
                Pending
            </a>
        </div>

        <div class="d-flex justify-content-end mb-3" style="margin-top: 20px;">
            <a href="{{ route('tasks.create') }}" class="custom-btn custom-btn-primary" style = "margin-left: 5px";>
                Create New Task
            </a>
        </div>
        
        <!-- Table container for HTMX updates -->
        <div id="tasks-table">
            @include('tasks.partials.task-table', ['tasks' => $tasks])
        </div>
    </div>
    
</x-app-layout>
