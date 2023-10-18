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
                    <span class="selected-option">Выберите приоритет</span>
                    <ul class="options">
                        <li data-value="1"><i class="icon-priority_low">иконка приоритета</i> Низкий</li>
                        <li data-value="2"><i class="icon-priority_medium">иконка приоритета</i> Средний</li>
                        <li data-value="3"><i class="icon-priority_high">иконка приоритета</i> Высокий</li>
                    </ul>
                    <input type="hidden" id="selected-value" name="priority_id">
                </div>
            </div>
            <div class="category-group">
                <select name="category_id">
                    @foreach($parentCategories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <textarea placeholder="Описание задачи..." rows="3" name="content" required></textarea>
            <div class="task-date">
                <label for="">
                    Дата начала
                    <input type="datetime-local" name="started_at" required>
                </label>
                <label for="">
                    Дата завершения
                    <input type="datetime-local" name="finished_at" required>
                </label>
            </div>
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
