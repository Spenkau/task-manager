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
                    </li>
                @endforeach
            </ul>
            <div class="pagination-tasks">
                <ul>
                    <li class="arrow-back"><</li>
                    <li class="active-page">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li class="ellipses">...</li>
                    <li>6</li>
                    <li class="arrow-next">></li>
                </ul>
            </div>
        </div>
        <div>
            @include('UIcomponents.timeDatePanel')
            @include('UIcomponents.observation')
        </div>
    </div>
@endsection
