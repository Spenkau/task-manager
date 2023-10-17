<div class="sidebar sidebar_hide">
    <div class="sidebar__logo">
        <img src="images/icons/logo.svg" alt="logo">
    </div>
    <h2>Категории</h2>
    <ul class="sidebar__list">
        @foreach($categories as $category)
            <li>
                <button>
                    <i class="icon-category"> иконка дома</i>
                    {{ $category['name'] }}
                </button>
                @if(count($category['children']) > 0)
                    @include('UIcomponents.categoryChild', ['children' => $category['children']])
                @endif
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
