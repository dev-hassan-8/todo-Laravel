@extends('layout')

@section('title', 'All Todos')

@section('styles')
    <style>
        .todos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .todos-header h2 {
            font-size: 1.8em;
            color: #333;
            margin: 0;
        }

        .todos-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .todo-item {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .todo-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .todo-item.completed {
            background: #e8f5e9;
            border-left-color: #4caf50;
        }

        .todo-item.completed .todo-title {
            text-decoration: line-through;
            color: #999;
        }

        .todo-content {
            flex: 1;
        }

        .todo-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .todo-description {
            font-size: 0.95em;
            color: #666;
            margin-bottom: 10px;
        }

        .todo-badge {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .todo-badge.pending {
            background-color: #ff9800;
        }

        .todo-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-left: 20px;
        }

        .todo-actions form {
            display: inline;
        }

        .todo-actions .btn {
            padding: 8px 15px;
            font-size: 0.9em;
        }

        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: #999;
        }

        .empty-state p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .empty-state .emoji {
            font-size: 4em;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="todos-header">
        <h2>Your Todos</h2>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">+ Add New Todo</a>
    </div>

    @if ($todos->isEmpty())
        <div class="empty-state">
            <div class="emoji">🎯</div>
            <p>No todos yet! Create one to get started.</p>
            <a href="{{ route('todos.create') }}" class="btn btn-primary">Create Your First Todo</a>
        </div>
    @else
        <ul class="todos-list">
            @foreach ($todos as $todo)
                <li class="todo-item {{ $todo->completed ? 'completed' : '' }}">
                    <div class="todo-content">
                        <div class="todo-title">{{ $todo->title }}</div>
                        @if ($todo->description)
                            <div class="todo-description">{{ $todo->description }}</div>
                        @endif
                        <span class="todo-badge {{ $todo->completed ? '' : 'pending' }}">
                            {{ $todo->completed ? ' Completed' : ' Pending' }}
                        </span>
                    </div>
                    <div class="todo-actions">
                        <form method="POST" action="{{ route('todos.toggle', $todo) }}" style="margin: 0;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-secondary">
                                {{ $todo->completed ? 'Mark Pending' : 'Mark Done' }}
                            </button>
                        </form>
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">Edit</a>
                        <form method="POST" action="{{ route('todos.destroy', $todo) }}" style="display: inline; margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
