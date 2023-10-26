@extends('layouts.layout')
@section('tags')
    <div class="tags-page">
        <div class="tags-page-container">
            <h2>Поиск по вашим тегам :)</h2>
            <div class="find-form">
                <form action="" method="post">
                    <input class="input-page" type="text" name="tag" placeholder="Введите тег...">
                </form>
            </div>
            @include('UIcomponents.tagsList', ['tags' => $tags])
            <ul class="search-task-list">
                @foreach($tasks as $task)
                    @include('UIcomponents.searchTaskCard', ['task'=> $task])
                @endforeach
            </ul>
        </div>
    </div>
@endsection
