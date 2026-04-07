@extends('layout')

@section('title', 'Create New Todo')

@section('content')
    <h2>Create New Todo</h2>

    <form method="POST" action="{{ route('todos.store') }}" style="margin-top: 30px;">
        @csrf

        <div class="form-group">
            <label for="title">Title <span style="color: #dc3545;">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                placeholder="Enter todo title"
                value="{{ old('title') }}"
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
            >{{ old('description') }}</textarea>
            @error('description')
                <span style="color: #dc3545; font-size: 0.9em; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Todo</button>
            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
