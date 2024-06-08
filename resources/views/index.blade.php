@extends('layouts.app')
@section('title','Task List')
    <!-- @isset($name)
    <h1>My name is {{$name}}</h1>
    @endisset -->
@section('content')
    <!-- @if (count($tasks))
            @foreach ($tasks as $task)
            <div>
                {{$task->title}}
            </div>
            @endforeach
        @else
            <div>
                There are no tasks
            </div>
        @endif -->
        @forelse ($tasks as $task )
        <div>
            <a href="{{ route('tasks.show', ['id'=> $task->id ]) }}">{{$task->title}}</a>
        </div>
        @empty
        <div>
            There are no tasks
        </div>
        @endforelse
@endsection




