<template>
    <div class="modal">
        <ul class="reaction-list">
            <li v-for="n in 16">
                <v-btn width="auto" height="auto">
                    <img :src="'/images/reaction/reaction_'+n+'.png'" width="35" height="35" alt="reaction">
                </v-btn>
            </li>
        </ul>
    </div>
</template>

<script setup>


</script>

<style scoped lang="scss">
.modal{
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    background: rgba(255,255,255,0.6);


}
.reaction-list{
    width: 40%;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}
</style>
