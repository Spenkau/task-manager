<div class="modal-category__overlay modal-category_disabled" id="overlay-task"> оверлей</div>
<div class="modal-task_container modal-category_disabled">
    <form id="task" class="decor" method="POST">
        @method('POST')
        @csrf
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать Задачу</h3>
            <div class="name-status-group">
                <input type="text" placeholder="Название задачи..." name="title" required>
                <div class="custom-select">
                    <span class="selected-option">Приоритет</span>
                    <ul class="options options-hidden">
                        <li data-value="1"><i class="icon-priority_low">иконка приоритета</i> Низкий</li>
                        <li data-value="2"><i class="icon-priority_medium">иконка приоритета</i> Средний</li>
                        <li data-value="3"><i class="icon-priority_high">иконка приоритета</i> Высокий</li>
                    </ul>
                    <input type="hidden" id="selected-value" name="priority">
                </div>
            </div>
            <div class="category-group">
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="1">КАТЕГОРИЯ 1</option>
                        <option value="2">КАТЕГОРИЯ 2</option>
                        <option value="3">КАТЕГОРИЯ 2</option>
                    @endforeach
                </select>
            </div>
            <textarea placeholder="Описание задачи..." rows="3" name="content" required></textarea>
            <div class="task-date">
                <label for="">
                    Дата начала
                    <input type="datetime-local" min="2023-10-18" required>
                </label>
                <label for="">
                    Дата завершения
                    <input type="datetime-local" required>
                </label>
            </div>
            <input type="text" maxlength="16" name="tag" placeholder="Введите тег задачи(необезательно)...">
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
