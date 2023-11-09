<template>
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
                        <p>{{user.name}}</p>
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
            <UserAchievements/>
            <ul class="user-task-list">
                <li v-for="(userTask,key) in userTasks" :key="key">
                    <MiniTaskCard :task="userTask"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import UserAchievements from "../components/widgets/UserAchievements.vue";
import {onMounted, ref} from "vue";
import {fetchTaskByPage} from "../contracts/сontracts";
import MiniTaskCard from "../components/widgets/MiniTaskCard.vue";
import {useUserStore} from "../dict/store/store";

const userTasks = ref([])

const store = useUserStore()
const user = store.user

console.log(store)


onMounted(async () => {
    // const tasksData = await fetchTaskByPage(1)
    // userTasks.value = tasksData.tasks.data
})

onMounted(() => {
    try {
        window.Echo.channel('task-channel')
            .listen('.task.created', (e) => {
                console.log(e.task);
                userTasks.value.unshift(e.task)
            })
            .error((error) => {
                console.error('Error:', error);
            })
    } catch (e) {
        console.error(e)
    }
})



</script>

<style scoped lang="scss">
@import "../../../css/general";

.user-task-list{
    margin-top: 60px;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

.icon-edit {
    @include icon(24px, 24px, 'edit');
}

.icon-apply {
    @include icon(24px, 24px, 'apply');
}

.icon-change {
    @include icon(32px, 32px, 'change')
}

.personal-area {
    display: flex;

    .icon-archive {
        @include icon(25px, 25px, 'archive');
    }

    .icon-invite {
        @include icon(25px, 25px, 'invite');
    }

    .icon-logout {
        transform: rotate(180deg);
    }
}


.personal-area_nav {
    position: absolute;
    background-color: $abs-white;
    font-size: 18px;
    padding-right: 30px;
    padding-top: 30px;
    padding-left: 30px;

    li {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    a {
        color: $black;
        display: block;
        cursor: pointer;
    }
}


.personal-area_body {
    width: 100%;
    padding: 30px;
}

.personal-area_body-info {
    display: block;

    h2 {
        font-size: 38px;
    }

    img {
        width: 128px;
    }

}

.button-edit {
    background-color: transparent;
    border: none;
    cursor: pointer;

}

.user-name {
    display: flex;

    input[disabled="disabled"] {
        background-color: transparent;
        font-size: 38px;
        font-style: normal;
        padding: 0;
        border: 1px solid transparent;
    }

    input {
        font-size: 38px;
        border: 1px solid $green;
        padding: 0;
        border-radius: 5px;
        background-color: white;
    }
}

.form-header {
    display: flex;
    gap: 30px;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
}

.user-about {
    display: flex;
    justify-content: center;
    padding-top: 30px;

    textarea {
        resize: none;
        font-size: 19px;
        font-family: $main-font;
        background-color: $abs-white;
        border: 1px solid $green;
        border-radius: 5px;
        height: 150px;


    }

    textarea[disabled="disabled"] {
        background-color: transparent;
        border: 1px solid transparent;
    }

    align-items: flex-start;
    gap: 150px;
}


.avatar {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: relative;
    cursor: pointer;

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

}

#change-avatar {
    position: relative;
    border-radius: 5px;
    background-color: white;
    right: 60px;
    top: 50px;
    border: none;
    cursor: pointer;
}

.len-hidden {
    display: none;
}

</style>
