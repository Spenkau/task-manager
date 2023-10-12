<div class="sidebar sidebar_hide">
    <div class="sidebar__logo">
        <img src="images/icons/logo.svg" width="64" height="64" alt="logo">
        <h1><span>T</span>ask <span>E</span>vent <span>M</span>anager</h1>
    </div>
    <h2>Категории</h2>
    <ul class="sidebar__list">
        @foreach($categories as $category)
            <li>
                <button>
                    <i> иконка дома</i>
                    {{$category -> name}}
                </button>
            </li>
        @endforeach
        <li class="list__new-category">
            <button type="button">
                <i class="icon-square-plus">иконка добавить задачу</i>
                Добавить
            </button>
        </li>
    </ul>
    <a class="logout" href="/signin"><i class="icon-logout">иконка выхода</i> Выйти</a>
</div>
