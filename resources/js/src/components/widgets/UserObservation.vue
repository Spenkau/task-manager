<template>
    <div class="observation">
        <h3>Наблюдение</h3>
        <p>Больше всего задач вы <button>создаете</button> в <span>Понедельник</span></p>
        <p>Больше всего задач вы завершаете в <span>Вторник</span></p>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped lang="scss">
@import "../../../../css/general";
.observation {
    background-color: $abs-white;
    padding: 40px;
    border-radius: 10px;
    border: 1px solid rgba(41, 161, 156, 0.3);
    margin-bottom: 80px;

h3 {
    color: $green;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
}

p {
    font-size: 18px;

span {
    color: $green;
}
}

p:not(p:last-child) {
    margin-bottom: 15px;
}

button {
    color: $green;
    border-bottom: 1px solid $green;
}

}
</style>
