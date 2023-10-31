<template>
  <h1>USER PAGE</h1>

  <div v-if="user"><h2>{{user.name}}</h2></div>
</template>

<script>
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
  name: "TaskPage",
  user: null,

  setup() {


    const fetchUser = async () => {
      try {
        const res = await axios.get(`/api/users/${username}`);
        if (res) {
          const data = await res.data();
          console.log(data)
        }
      } catch (e) {
        console.error('Ошибка получения данных:', e);
      }
    }

    onMounted(() => {
      fetchUser();

    })
  }
}
</script>

<style scoped>

</style>
