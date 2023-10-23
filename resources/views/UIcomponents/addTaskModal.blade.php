<div class="modal-category__overlay modal-category_disabled" id="overlay-task"> оверлей</div>
<div class="modal-task_container modal-category_disabled">
    <form id="task" class="decor" method="POST" action="{{ route('tasks.store')  }}">
        @csrf
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать Задачу</h3>
            <div class="name-status-group">
                <input type="text" placeholder="Название задачи..." name="title" required>
                <div class="custom-select">
                    <p class="selected-option"><i class="icon-arrow-down"> стрелка вниз</i><span>Приоритет</span></p>
                    <ul class="options options_hidden">
                        <li data-value="1"><i class="icon-priority_low">иконка приоритета</i> Низкий</li>
                        <li data-value="2"><i class="icon-priority_medium">иконка приоритета</i> Средний</li>
                        <li data-value="3"><i class="icon-priority_high">иконка приоритета</i> Высокий</li>
                    </ul>
                    <input type="hidden" id="selected-value" name="priority_id">
                </div>
            </div>
            <div class="category-group custom-select">
                <span class="selected-option selected-category"><i class="icon-arrow-down">иконка вниз</i>Категория</span>
                <ul class="options options-category options_hidden">
                    @foreach($allCategories as $category)
                        <li data-value="{{ $category['id'] }}">
                            <i class="icon-category">иконка категории</i>
                            {{ $category['name'] }}
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="category_id" class="input-category">
            </div>
            <textarea placeholder="Описание задачи..." rows="3" name="content" required></textarea>
            <div class="task-date">
                <label for="">
                    Дата начала
                    <input type="datetime-local" min="2023-10-18" name="started_at" required>
                </label>
                <label for="">
                    Дата завершения
                    <input type="datetime-local" name="finished_at" required>
                </label>
            </div>
            <input type="text" name="tag" placeholder="Введите тег задачи (необезательно)...">
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
