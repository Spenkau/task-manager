<template>
  <div class="complete-task">
    <button @click="() => completeTask()">
      <i class="icon-complete">завершить</i>
    </button>
  </div>
</template>

<script setup>
import api from "../../dict/axios/api";

const props = defineProps(['taskID'])
const id = props.taskID

// TODO перенести функцию в более разумное место
function formatISO8601DateTime(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');

  return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
}

const taskDeleteData = {id: id, finished_at: formatISO8601DateTime(new Date())}

const completeTask = () => {
  api.post('tasks/finish', taskDeleteData).then(res => console.log(res))
}
</script>

<style scoped lang="scss">
.complete-task {
  display: flex;
  align-items: center;
}

i {
  background-color: grey;
}
</style>
