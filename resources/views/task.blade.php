@extends('layouts.layout')
@section('task')
    <div class="task-page">
        <div class="task-page-container">
            <a class="link-back" href="{{ route('tasks.index') }}"><i class="icon-arrow-back">иконка назад</i> Вернуться</a>
            <h1 class="task-name">{{$task['title']}}</h1>
            <h2 class="task-category">категория {{$task['category_id']}}</h2>
            <div class="task-options">
                <p class="task-status">
                    @switch($task['status_id'])
                        @case(0)
                        Удаленно
                        @break
                        @case(1)
                        <i class="icon-process">иконка процесса</i>В процессе
                        @break
                        @case(2)
                        Отложенно
                        @break
                        @case(3)
                        Завершенно
                        @break
                    @endswitch
                </p>
                <p class="task-priority"> Приоритет
                    @switch($task['priority_id'])
                        @case(1)
                        Низкий <i class="icon-priority_low"></i>
                        @break
                        @case(2)
                        Обычный <i class="icon-priority_medium"></i>
                        @break
                        @case(3)
                        Высокий <i class="icon-priority_high"></i>
                        @break
                    @endswitch
                </p>
                <p class="task-date">
                    @if($task['started_at'] && $task['finished_at'])
                        C {{$task['started_at']}} по {{$task['finished_at']}}
                    @elseif($task['started_at'] || $task['finished_at'])
                        {{$task['started_at'] || $task['finished_at']}}
                    @else
                        Дата не указана
                    @endif
                </p>
            </div>
            <p class="task-content">{{$task['content']}}</p>
            @if($task['status_id'] !== 0)
                <div class="task-settings">
                    @if($task['status_id'] === 1)
                        <button><i class="icon-rewrite"></i> редатктировать</button>
                    @endif
                    <button><i class="icon-share"></i> поделиться</button>
                    @if($task['status_id'] !== 2)
                        <button><i class="icon-postpone"></i> отложить</button>
                    @endif
                </div>
            @endif
            @if($task['status_id'] !== 0)
                @if($task['status_id'] !== 0)
                    <button class="task-page-delete"><i class="icon-delete"> иконка удалить</i></button>
                @endif
                @if($task['status_id'] !== 3)
                    <button class="task-page-complete"><i class="icon-complete"> иконка завершить</i></button>
                @endif
            @endif
            <div class="write-comment">
                <form action="" method="post">
                    <input class="input-commit input-page" type="text" name="comment" minlength="10" placeholder="Оставьте комментарий для задачи...">
                    <input type="submit" value="Отправить" class="input-submit-commit disabled">
                </form>
            </div>
            <div class="task-comments">
                <ul class="comment-list">
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Maxim</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="right">
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Alex</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Andry</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">CJ</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Cebastian</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="user-comment">
                            <img src="/images/avatar.png" alt="user avatar">
                            <div class="comment">
                                <p class="user-name">Dolly</p>
                                <p class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At doloribus ducimus eaque eius et iure modi molestiae nesciunt nostrum, perspiciatis quia quidem quisquam saepe unde, veniam voluptatem voluptatibus. Soluta, ullam!
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{--<ul>--}}
    {{--    <li class="w-screen">--}}
    {{--        {{ $task['title'] }}--}}
    {{--    </li>--}}
    {{--    <li>--}}
    {{--        {{ $task['content'] }}--}}
    {{--    </li>--}}
    {{--    <hr/>--}}
    {{--    <br>--}}
    {{--    <li class="flex">--}}
    {{--
    {{--        <a href="{{ route('post.edit', $task['id']) }}" class="btn btn-blue">Edit</a>--}}
    {{--        <form--}}
    {{--            action="{{ route('task.delete', $task['id']) }}"--}}
    {{--            method="POST"--}}
    {{--        >--}}
    {{--            @csrf--}}
    {{--            @method('DELETE')--}}
    {{--            <input type="submit" value="Delete" class="btn btn-blue cursor-pointer">--}}
    {{--        </form>--}}
    {{--    </li>--}}
    {{--</ul>--}}
@endsection
