@extends('layouts.layout')
@section('personal_area')
    <div class="personal-area">
        <div class="personal-area_nav">
            <ul>
                <li>
                    <i class="icon-archive">иконка архива задач</i>
                    <a href="#">Архив задач</a>
                </li>
                <li>
                    <i class="icon-invite">иконка приглашения</i>
                    <a href="#">Приглашение на задачу</a>
                </li>
                <li>
                    <i class="icon-logout">иконка выхода</i>
                    <a href="#">Выйти</a>
                </li>
            </ul>
        </div>
        <div class="personal-area_body">
            <form class="personal-area_body-info">
                @csrf
                <div class="form-header">
                    <div class="avatar" id="avatar">
                        <img src="images/avatar.png" alt="User Avatar" id="avatar-img">
                        <input type="file" id="avatar-input" accept="image/*" style="display: none">
                    </div>
                    <button id="change-avatar"><i class="icon-change">Изменить аватар</i></button>
                    <div>
                        <div class="user-name">
                            <input class="name" name="username" value="Username" disabled="disabled">
                            <button type="button" class="button-edit"><i class="icon-edit">редактировать</i></button>
                        </div>
                        <p>@user_login</p>
                    </div>
                </div>
                <div class="user-about">
                    <div>
                        <textarea name="user-desc" cols="30" rows="10" maxlength="255" disabled="disabled">Я Такой такой то человек, у меня много много дел</textarea>
                        <p class="about-length len-hidden">Длина рассказа: <span></span>/255</p>
                    </div>
                    <button type="button" class="button-edit"><i class="icon-edit">редактировать</i></button>
                </div>
            </form>
        </div>
    </div>
    @include('UIcomponents.accountSuccess')
@endsection
