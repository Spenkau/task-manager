<div class="modal-category__overlay modal-category_disabled" id="overlay-task"> оверлей</div>
<div class="modal-task_container modal-category_disabled">
    <form id="task" class="decor" >
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать Задачу</h3>
            <input type="text" placeholder="Название задачи..." name="name" required>
            <div class="category-group">
                <select name="" id="">
                    @foreach($categories as $category)
                        <option>КАТЕГОРИЯ</option>
                    @endforeach
                </select>
            </div>
            <div class="radio-group">
                <input type="radio" name="radioGroup" value="HIGH" id="option1">
                <label for="option1">Важно</label>

                <input type="radio" name="radioGroup" value="MEDIUM" id="option2" checked>
                <label for="option2">Обычно</label>

                <input type="radio" name="radioGroup" value="LOW" id="option3">
                <label for="option3">Не важно</label>
            </div>
            <textarea placeholder="Описание задачи..." rows="3"></textarea>
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
