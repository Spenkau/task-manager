<div class="modal-category__overlay modal-category_disabled" id="overlay-category"> оверлэй</div>
<div class="modal-category_container modal-category_disabled">
    <form id="category" class="decor" method="POST" action={{ route('categories.store') }}>
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Создать категорию</h3>
            <input type="text" placeholder="Название категории..." name="name" required>
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>




