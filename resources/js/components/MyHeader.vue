<template>
    <div class="my_container">
        <a href="/admin">Area Amministrativa</a>
    </div>
</template>

<script>
    export default{
        name: "MyHeader",
        components: {
            
        },
        methods:{
            
        }
    }
</script>

<style scoped lang="scss">
    .my_container{
        background-color: #a7a9be;
        width: 15%;
        height: 100vh;
        padding: 10px;

        a{
            text-decoration: none;
            color: #fffffe;
        }
    }
</style>
