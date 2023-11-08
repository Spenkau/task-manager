<template>
    <div class="task-comments">
        <ul class="comment-list">
            <li v-for="(comment,key) in comments" class="comment">
                <CommentItem :comment = "comment" :key="key"/>
            </li>
        </ul>
    </div>
</template>

<script setup>
import CommentItem from "./CommentItem.vue";
import {onMounted, ref} from "vue";
const comments = ref([])

onMounted(()=>{
    try {
        window.Echo.channel('comment-channel')
            .listen('.comment', (e) => {
                console.log('welcome to comment channel');
                console.log(e)
                comments.value.unshift(e)

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
@import "../../../../css/general";
.task-comments {
    margin-top: 60px;
    width: 920px;


}
.comment {
    width: min-content;
    margin-bottom: 45px;

    &:nth-child(even) {
        .user-comment {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
            text-align: end;
        }

        margin-left: auto;

        .comment {
            order: 1;
        }

        img {
            order: 0;
        }

    }
}

.comment-list {
    display: block;
}
</style>
