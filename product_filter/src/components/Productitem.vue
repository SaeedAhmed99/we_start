<template>
    <div class="box">
        <img  alt="">
        <h3><a href="">{{product.title}}</a></h3>
        <p>{{product.price}} $</p>
        <p>{{product.category}}</p>
        <span v-for="(color, i) in product.color" :key="i">{{color}}</span>
    </div>
</template>


<script>
export default {
    props: ['product']
}
</script>


<style scoped>
    .box {
        width: 31%;
        margin: 1%;
        background: rgb(194, 188, 188);
        padding: 5px 20px;
        min-height: 250px;
        overflow: hidden;
        border-radius: 5px;
    }
    .box a {
        text-decoration: none;
        color: rgb(246, 42, 236);
    }
    .box span {
        font-size: 13px;
        padding: 2px 5px;
        background: rgb(212, 212, 212);
        margin: 0 2px;
        border-radius: 3px;
    }
</style>