<template>
  <h1>TEST PAGE</h1>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
  name: "TaskPage",

  setup() {
    const data = ref([]);

    const getData = async () => {
      try {
        const res = await fetch('http://127.0.0.1:8000/api/test');
        if (res.ok) {
          const data = await res.json();
          console.log(data)
          data.value = data.data
        }
      } catch (e) {
        console.error('Ошибка получения данных:', e);
      }
    }

    onMounted(() => {
      getData();

    })
  }
}
</script>

<style scoped>

</style>
