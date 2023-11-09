<template>
    <div>
        <h1><span>404</span> - Страница не найдена</h1>
        <RouterLink to="/main"> вернуться на главную </RouterLink>
    </div>
</template>

<script>
export default {
    name: "NotFoundPage"
}
</script>

<style scoped lang="scss">
    div{
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    span{
        font-size: 256px;
        font-weight: 900;
    }
    h1{
        font-size: 32px;
    }
    a{
        margin-top: 10px;
        text-decoration-line: underline;
        &:hover{
            opacity: .8;
        }
    }
</style>
