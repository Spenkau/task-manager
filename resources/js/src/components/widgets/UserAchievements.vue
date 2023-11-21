<template>
    <div class="account-success">
        <h2>Успехи аккаунта</h2>
        <div class="success-body">
            <ul>
                <li class="success-item">
                    <span>Создано</span>
                    <div class="success-item_body">
                        <div>
                            <p>113</p>
                            задач
                        </div>
                    </div>
                </li>
                <li class="success-item">
                    <span>Завершнено</span>
                    <div class="success-item_body">
                        <div>
                            <p>113</p>
                            задач
                        </div>
                    </div>
                </li>
                <li class="success-item">
                    <span>Удалено</span>
                    <div class="success-item_body">
                        <div>
                            <p>113</p>
                            задач
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script setup lang="ts">

</script>

<style scoped lang="scss">
@import "../../../../css/general";

.account-success{
    display: block;
    background-color: $abs-white;
    padding: 30px;
    width: 32vw;
    border-radius: 15px;
    border: 1px solid rgba(41, 161, 156, 0.3);
    h2{
        display: flex;
        justify-content: flex-start;
        font-size: 20px;
        font-weight: 600;
        color: $green;
        margin-bottom: 20px;
    }
}

.success-item{
    .success-item_body{
        margin-top: 10px;
    }
    >span{
        width: 100%;
        display: flex;
        justify-content: center;
    }
}

.success-body{
    ul{
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .success-item_body{
        display: flex;
        align-items: center;
        justify-content: center;
        border:1px solid $green;
        border-radius: 50%;
        padding: 30px;
        width: 125px;
        height: 125px;
        div{
            text-align: center;
            font-size: 14px;
        }
        p{
            font-size: 32px;
            font-weight: 700;
            color: $green;
        }
    }
}
</style>
