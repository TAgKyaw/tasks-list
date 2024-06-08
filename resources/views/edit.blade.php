@extends('layouts.app')
@section('title','Creating a task')

@section('styles')
<style>
    .error-message {
        color: red;
        font-size: 0.8rem;
    }
</style>
@section('content')
    <form action="{{ route('tasks.update', ['task'=> $task->id ] )}}" method="POST">
        @csrf
        @method('PUT') <!--Method spoofing overriding the form method to put -->
        <div>
            <label for="title">
                Title
            </label>
            <input type="text" name="title", id="title" value='{{$task->title}}'>
            @error('title')
            <p class='error-message'>{{$message}} </p>
            @enderror
        </div>
        <div>
            <label for="description">
                description
            </label>
            <textarea name="description", id="description" rows="5">{{$task->description}}</textarea>
            @error('description')
            <p class='error-message'>{{$message}} </p>
            @enderror
        </div>
        </div>
        <div>
            <label for="long_description">
                long_description
            </label>
            <textarea name="long_description", id="long_description" rows="10">{{$task->long_description}}</textarea>
            @error('long_description')
            <p class='error-message'>{{$message}} </p>
            @enderror
        </div>
        </div>
        <div>
            <button type="submit">Edit Task</button>
        </div>
    </form>
@endsection