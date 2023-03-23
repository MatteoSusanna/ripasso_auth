<template>
    <div class="my_container">
        <div class="container d-flex">
            <div class="card m-3" style="width: 18rem;" v-for="(anim, index) in anime" :key="index">
                <div class="my_img">
                    <img :src="anim.cover" class="card-img-top" :alt="anim.nome">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{anim.nome}}</h5>
                    <p class="card-text">{{getTroncateText(anim.content, 100) + '...'}}</p>

                    <div class="mb-3">
                        <i v-for="(n, index) in 5" :key="index" class="fa-star" :class="(n<=anim.vote)?'fa-solid':'fa-regular'"></i>
                    </div>

                    <router-link class="my_button" :to="{name: 'anime', params: {slug: anim.slug}}" title="Maggiori dettagli">Vedi</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default{
        data(){
            return{
                anime: [],
            }
        },
        methods:{
            getAnime(){
                axios.get('/api/anime')
                .then(res=>{
                    this.anime = res.data.results;
                    console.log(res.data.results);
                })
            },
            getTroncateText(text, numCar){
                return text.slice(0, numCar);
            }
        },
        mounted(){
            this.getAnime()
        }
    }
</script>

<style scoped lang="scss">
    .my_container{
        background-color: #0f0e17;
        width: 85%;
        height: 100vh;
        padding: 30px;

        .my_button{
            border-radius: 6px;
            background-color: #ff8906;
            color: white;
            padding: 5px 10px;
            border: none;
                &:hover{
                    opacity: 0.9;
                }
            }
        }
        .my_img{
            width: 100%;
            height: 10rem;
            img{
                height: 100%;
                object-fit: cover;
            }
        }

</style>
