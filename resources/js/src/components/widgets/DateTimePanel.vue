<template>
    <div class="time-date-section">
        <div class="time-date-container">
            <p>Такс такс такс</p>
            <div>
                <ul class="time-list">
                    <li>На часах у нас</li>
                    <li><i class="icon-time"> иконка часов </i> <span class="time"> {{ currentTime}} </span></li>
                </ul>
                <ul class="date-list">
                    <li> А сегодня у нас</li>
                    <li><i class="icon-calendar"> иконка календаря</i> <span class="date"> {{ currentDate }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {ref, onMounted} from "vue"

const currentTime = ref( new Date().toLocaleTimeString())
const currentDate = ref( new Date().toLocaleDateString(
    ["by","ru"],
    {year: 'numeric', month: 'long', day: 'numeric'}
))

const updateTime = ()=>{
    setInterval(() => {
        currentTime.value = new Date().toLocaleTimeString()
    }, 100)
}

onMounted(()=>{
    updateTime()
})

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.time-date-section {
    width: 500px;
    max-height: 160px;
    padding: 30px;
    background-color: $abs-white;
    border-radius: 10px;
    margin-bottom: 80px;
    border: 1px solid rgba(41, 161, 156, 0.3);
}

.icon-time {
    @include icon(24px, 24px, 'clock')
}

.icon-calendar {
    @include icon(24px, 24px, 'calendar')
}

.time-date-container {
    p {
        color: $green;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    div {
        display: flex;
        gap: 30px;
    }
}

.date-list, .time-list {
    li:not(li:last-child) {
        margin-bottom: 15px;
    }

    li:not(li:first-child) {
        display: flex;
        align-items: center;
        gap: 5px;
    }
}

.time, .date {
    font-size: 26px;

}

</style>
