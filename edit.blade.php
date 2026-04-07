@extends('layout')

@section('title', 'Edit Todo')

@section('content')
    <h2>Edit Todo</h2>

    <form method="POST" action="{{ route('todos.update', $todo) }}" style="margin-top: 30px;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title <span style="color: #dc3545;">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                placeholder="Enter todo title"
                value="{{ old('title', $todo->title) }}"
                required
            >
            @error('title')
                <span style="color: #dc3545; font-size: 0.9em; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                placeholder="Enter todo description (optional)"
            >{{ old('description', $todo->description) }}</textarea>
            @error('description')
                <span style="color: #dc3545; font-size: 0.9em; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="completed">
                <input type="checkbox" id="completed" name="completed" value="1" {{ old('completed', $todo->completed) ? 'checked' : '' }}>
                <span style="margin-left: 8px;">Mark as completed</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Todo</button>
            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
