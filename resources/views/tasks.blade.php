<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All tasks</title>
</head>
<body>
@if(\Illuminate\Support\Facades\Session::has('message'))
    <div class="absolute left-[200px] top-[50px]">
        {{ \Illuminate\Support\Facades\Session::get('message') }}
    </div>
@endif
<ul>
    @foreach($tasks as $task)
        <li>
            <p>
                <a href="{{ route('tasks.show', $task['id'])}}">
                    {{ $task['title'] }}
                </a>
                @if($task['parent_id'])
                    --- PARENT: {{ $task['parent_id'] }}
                @endif
            </p>
            <p>CONTENT: {{ $task['content'] }}</p>
            <p>USER: {{ $task['user_id'] }}</p>
            <p>CATEGORY: {{ $task['category_id'] }}</p>
            <p>STATUS: {{ \App\Enums\StatusEnum::from($task['status_id'])->name }}</p>
            <p>PRIORITY: {{ \App\Enums\PriorityEnum::from($task['priority_id'])->name }}</p>

            <button>Начать</button>
            <button>Закончить</button>
        </li>
    @endforeach
</ul>
</body>
</html>
