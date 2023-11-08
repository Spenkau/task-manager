<template>
    <div class="user-comment">
        <img src="/images/avatar.png" alt="user avatar">
        <div class="comment">
            <p class="user-name">{{ comment.comment.user_name }}</p>
            <p class="comment-text">
                {{ comment.comment.user_msg }}
            </p>
        </div>
    </div>
</template>

<script setup>
const comment = defineProps(['comment'])
console.log(comment)

</script>

<style scoped lang="scss">


img {
    width: 64px;
    height: 64px
}


.user-comment {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.comment-text {
    width: 450px;
    line-height: 23px;
    opacity: 0.8;
    word-break: break-word;
}

.user-name {
    margin-bottom: 10px;
}

</style>
