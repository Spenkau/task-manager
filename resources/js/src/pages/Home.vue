<template>
    <TheHeader>
        <i class="icon-sidebar-open" @mousemove="showSidebar = true"> открыть сайдбар </i>
    </TheHeader>
    <div class="body-main">
        <div class="left" @mousemove="showSidebar=true"></div>
        <Sidebar v-if="showSidebar">
            <div class="sidebar"></div>
        </Sidebar>
        <section class="main">
            <div class="active-task">
                <h2>Активные задачи</h2>
            </div>
            <DateTimePanel/>
        </section>
    </div>
</template>

<script>
import TheHeader from "../components/header/TheHeader.vue";
import Sidebar from "../components/sidebar/Sidebar.vue";
import DateTimePanel from "../components/DateTimePanel.vue";

export default {
    name: "Home",
    components: {DateTimePanel, Sidebar, TheHeader},
    data() {
        return {
            showSidebar: false
        }
    },


}
</script>

<style scoped lang="scss">
@import "../../../css/general";

.sidebar {
    position: fixed;
    z-index: 5;
    top: 0;
    left: 0;
    height: 100%;
    overflow-y: scroll;

    &::-webkit-scrollbar {
        width: 0;
    }
}

.icon-sidebar-open {
    position: absolute;
    left: 20px;
    top: 40px;
    @include icon(30px, 30px, "open_sb");
    z-index: 3;
}

</style>
