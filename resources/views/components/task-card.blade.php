<div class="item-task">
    <div class="task-delete">
        <button>
            <i class="icon-delete"> Удалить</i>
        </button>
    </div>
    <div class="task-card">
        <div class="task-header">
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
                <i class="icon-tag">иконка тега</i>
                <span>Тег</span>
            </p>
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
        </div>
    </div>
    <div class="task-complete">
        <button>
            <i class="icon-complete"> Завершить</i>
        </button>
    </div>
</div>
