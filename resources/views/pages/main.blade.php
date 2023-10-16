@extends('layouts.layout')
@section('main')
    <x-header :isAuth="true"></x-header>
    <x-sidebar :categories="$categories"></x-sidebar>
    @include('UIcomponents.addCategoryModal')
    @include('UIcomponents.addTaskModal')
    <div class="body-main">
        <div class="task-list">
            <ul>
                <li class="task-item">
                    <div class="item-task">
                        <div class="task-delete">
                            <button>
                                <i class="icon-delete"> Удалить</i>
                            </button>
                        </div>
                        <div class="task-card">
                            <div class="task-header">
                                <p class="task-card-date">
                                    C
                                    <span>20.03.2023</span>
                                    по
                                    <span>27.04.2023</span>
                                </p>
                                <p class="task-card-category">
                                    <i class="icon-category">иконка категории</i>
                                    <span>Работа</span>
                                </p>
                            </div>
                            <div class="task-body">
                                <h3><a href="#">Почитать документацию по laravel</a></h3>
                                <i class="icon-priority_high">иконка приоритета</i>
                            </div>
                            <div class="task-footer">
                                <button><i class="icon-rewrite"></i> реадктировать</button>
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
                </li>
            </ul>
        </div>
        <div>
            @include('UIcomponents.timeDatePanel')
        </div>
    </div>
@endsection
