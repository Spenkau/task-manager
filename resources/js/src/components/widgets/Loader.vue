<template>
<div class="layers">
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
</div>
</template>

<script setup>

</script>

<style scoped lang="scss">
.layers {
    position: relative;
    top: 350px;
    transform: scaleY(0.5) scaleX(1.5);
    animation: scale ease-in-out 10s infinite;
}

@keyframes scale {
    50% {
        transform: rotateX(45deg) rotateZ(45deg) translate3d(0vh,0vh,15vh) scale(1);
    }
}

p {
    position: absolute;
    width: 10vw;
    height: 10vw;
    background: rgba(255,0,0,0.25);
}

@for $i from -6 to 6 {
    p:nth-child(#{$i+6}) {
        transform: rotateX(45deg) rotateZ(45deg) translate3d(0vh,0vh,$i*17vh);
        filter:  hue-rotate(($i+6)*36deg);
        animation: slide#{$i} ease-in-out 10s infinite;
    }
    @keyframes slide#{$i} {
50% {
    transform: rotateX(45deg) rotateZ(45deg) translate3d(0vh,0vh,-$i*17vh) scale(0.5 + 0.05*$i);
}
}
}
</style>
