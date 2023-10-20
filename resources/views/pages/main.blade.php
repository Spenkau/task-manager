@extends('layouts.layout')
@section('main')
    <x-header :isAuth="true"></x-header>
    <x-sidebar :categories="$categories"></x-sidebar>
    @include('UIcomponents.addCategoryModal')
    @include('UIcomponents.addTaskModal')
    <div class="body-main">
        <div class="task-list">
            <h3 class="list-header">Активные задачи</h3>
            <ul class="active-tasks">
                @foreach($tasks as $task)
                    <li>
                        <x-taskCard :task="$task"></x-taskCard>
                        @if(count($task["children"]) > 0)
                            <div class="child">
                                @foreach($task["children"] as $child)
                                    <x-taskCard :task="$child"></x-taskCard>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
            <div class="pagination-tasks">
                {{ $tasks->links() }}
            </div>
        </div>
        <div>
            @include('UIcomponents.timeDatePanel')
            @include('UIcomponents.observation')
        </div>
    </div>
@endsection
