<header>
    <div class="header">
        <div class="header__buttons">
            <button class="button__create-task" type="button">
                <i class="icon-plus"> иконка плюса </i>
                Новая задача
            </button>
            <button class="button__change-color-mode"><i class="icon-moon"> Переключатель цветового режима </i></button>
        </div>
        @if($isAuth)
            <div class="header__container">
                <i class="icon-sidebar-open"> открыть сайдбар </i>
                <p>Хорешего дня, <span> username </span></p>
                <button class="container-button">
                    <div>
                        <img src="images/avatar.png" width="45" height="45" alt="картинка пользователя">
                        <div class="container__layout-icon">
                            <i class="icon-arrow-down"> Отрыть панель опций </i>
                        </div>
                    </div>
                </button>
                <div class="header__overlay disabled">
                    <div class="overlay__modal">
                        <ul class="modal__list">
                            <li>
                                <a href="/personal-area">
                                    <i class="icon-user"> иконка личного кабинета </i>
                                    Личный кабинет
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="icon-moon"> иконка смены цветового режима </i>
                                    Темный режим
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="icon-settings"> иконка настроек </i>
                                    Настройки
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="icon-logout"> иконка выйти из аккаунты </i>
                                    Выйти
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="header__auth-buttons">
                <a href="/auth"><i class="icon-auth"> иконка авторизации </i> Войти </a>
                <a href="/register"><i class="icon-reg"> иконка регистрации </i> Создать аккаунт </a>
            </div>
        @endif
        <input type="hidden" id="isAuth" name="isAuth" value="{{$isAuth}}">
    </div>
</header>
