<div class="item-task">
    <div class="task-delete">
        <button>
            <i class="icon-delete"> Удалить</i>
        </button>
    </div>
    <div class="task-card">
        <div class="task-header">
            @if($task['started_at'] && $task['finished_at'])
                <p class="task-card-date">
                    C
                    <span>{{ $task['started_at'] }}</span>
                    по
                    <span>{{ $task['finished_at'] }}</span>
                </p>
            @endif
            <p class="task-card-category">
                <i class="icon-category">иконка категории</i>
                <span>{{ $task['category_id'] }}</span>
            </p>
        </div>
        <div class="task-body">
            <h3><a href="{{ route('tasks.show', $task['id']) }}">Почитать документацию по laravel</a></h3>
            <i class="icon-priority_high">иконка приоритета</i>
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
