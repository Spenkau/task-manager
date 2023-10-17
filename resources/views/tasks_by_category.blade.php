<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks by category {{ $slug }}</title>
</head>
<body>
    {{ $slug }}
{{--<ul>--}}
{{--    @foreach($tasks as $task)--}}
{{--        <li>--}}
{{--            <p>--}}
{{--                {{ $task->title }}--}}
{{--                @if(isset($task->parentId))--}}
{{--                    --- PARENT: {{ $task->parentId }}--}}
{{--                @endif--}}
{{--            </p>--}}
{{--            <p>{{ $task->content }}</p>--}}
{{--            <p>{{ $task->category->name }}</p>--}}
{{--            <p>STATUS: {{ \App\Enums\StatusEnum::from($task->status_id)->name }}</p>--}}
{{--            <p>PRIORITY: {{ \App\Enums\PriorityEnum::from($task->priority_id)->name }}</p>--}}

{{--            <button>Начать</button>--}}
{{--            <button>Закончить</button>--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}
</body>
</html>
