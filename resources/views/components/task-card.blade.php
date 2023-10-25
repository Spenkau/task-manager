<div class="tasks-container">
    <div class="item-task">
        <div class="task-delete">
            <button>
                <i class="icon-delete"> Удалить</i>
            </button>
        </div>
        <div class="task-card">
            <div class="task-header">
                <p>
                    {{ $task['id'] }}
                </p>
                <p class="task-card-date">
                    @if($task['started_at'] && $task['finished_at'])
                        C
                        <span>{{ $task['started_at'] }}</span>
                        по
                        <span>{{ $task['finished_at'] }}</span>
                    @else
                        Дата не указана
                    @endif
                </p>
                <p class="task-card-category">
                    <i class="icon-category">иконка категории</i>
                    <span>{{ $task['category_id'] }}</span>
                </p>
                <p class="task-card-tag">
                <ul>
                    @foreach($task['tags'] as $tag)
                        <li>
                            <i class="icon-tag">иконка тега</i>
                            <a href="/tags"><span>{{ $tag['name'] }}</span></a>
                        </li>
                    @endforeach
                </ul>

                </p>
                <div class="task-card-reaction">
                    <div class="reaction-content">
                        <a href="/user/1">
                            <img src="/images/reaction/reaction_13.png" alt="реакция">
                        </a>
                        <span>3</span>
                    </div>
                    <div class="reaction-content">
                        <a href="/user/1">
                            <img src="/images/reaction/reaction_14.png" alt="реакция">
                        </a>
                        <span>6</span>
                    </div>
                    <div class="reaction-content">
                        <a href="/user/1">
                            <img src="/images/reaction/reaction_10.png" alt="реакция">
                        </a>
                        <span>2</span>
                    </div>
                </div>
            </div>
            <div class="task-body">
                <h3><a href="{{ route('tasks.show', $task['id']) }}">{{$task['title']}}</a></h3>
                @if($task['priority_id'] === 1)
                    <i class="icon-priority_low">иконка приоритета</i>
                @elseif($task['priority_id'] === 2)
                    <i class="icon-priority_medium">иконка приоритета</i>
                @else
                    <i class="icon-priority_high">иконка приоритета</i>
                @endif

                {{--            {{ \App\Enums\PriorityEnum::from($task['priority_id'])->name }}--}}
            </div>
            <div class="task-footer">
                <button><i class="icon-rewrite"></i> редактировать</button>
                <button><i class="icon-share"></i> поделиться</button>
                <button><i class="icon-postpone"></i> отложить</button>
                @if(count($task["children"]))
                    <button class="toggle-show-child">
                        <i class="icon-show-all"></i><span class="count-child">{{count($task["children"])}}</span> подзадач
                    </button>
                @endif
            </div>
        </div>
        <div class="task-complete">
            <button>
                <i class="icon-complete"> Завершить</i>
            </button>
        </div>
    </div>

    @if(count($task["children"]) > 0)
        @include("UIcomponents.taskChild", ['children' => $task["children"]])
    @endif
</div>
