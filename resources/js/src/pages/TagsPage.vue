<template>
<div class="tags-page">
    <v-text-field
        label="Поиск"
        prepend-icon="$vuetify"
        variant="underlined"
    ></v-text-field>
</div>
</template>

<script setup lang="ts">

</script>

<style scoped lang="scss">
@import "../../../css/general";

.tags-page{
    display: flex;
    justify-content: center;
    background:$white url("/public/images/bg/figure.svg") repeat 260px 760px;
    min-height: 760px;
    padding-top: 80px;
    padding-bottom: 80px;
h2{
    text-align: center;
    font-size: 50px;
    font-weight: 700;
}
}
</style>
