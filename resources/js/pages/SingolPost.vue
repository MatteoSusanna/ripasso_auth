<template>
    <div class="my_container">

        <div class="my_container_card mb-3">
            <div class="my_card">
                <div class="my_img mb-3">
                    <span class="my_banner">{{visionato}}</span>
                    <img :src="anime.cover" :alt="anime.nome">
                </div>
                <div class="mb-3">
                    <i v-for="(n, index) in 5" :key="index" class="fa-star fa-2x" :class="(n<=anime.vote)?'fa-solid':'fa-regular'"></i>
                </div>
                <h5 class="card-title"><strong>{{anime.nome}}</strong></h5>

                <div class="d-flex">
                    <span class="my_badge mx-1" v-for="(category, index) in anime.categories" :key="index">{{category.nome}}</span>
                </div>

                <p class="card-text">{{anime.content}}</p>
            </div>
        </div>


        <a class="btn btn-primary" href="/">Indietro</a>
    </div>
</template>

<script>
    import axios from "axios";

    export default{
        data(){
            return{
                anime: [],
                visionato: ''
            }
        },
        methods:{
        },
        mounted(){
            let slug = this.$route.params.slug;

            axios.get('/api/anime/' + slug)
            .then(res =>{
                this.anime = res.data.results

                if(res.data.results.visionato == 'no'){
                    this.visionato = 'In corso...'
                }else{
                    this.visionato = 'Completo'
                }
                console.log(res.data.results)
            })
        }
    }
</script>

<style scoped lang="scss">
.my_container{
    width: 85%;
    height: 100vh;
    background-color: #0f0e17;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.my_container_card{
    width: 30rem;
    border-radius: 10px;
    overflow: hidden;
    border-color: 5px solid white;
    background-color: white;
}

.my_card{
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    p{
        padding: 15px;
    }
}

.my_img{
    width: 100%;
    height: 400px;
    margin: 0 auto;
    position: relative;

    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
}

.my_badge{
    padding: 2px 5px;
    font-size: 11px;
    background-color: #0f0e17;
    color: white;
    border-radius: 6px;
}

.my_banner{
    position: absolute;
    padding: 2px 5px;
    top: 2px;
    left: 2px;
    color: white;
    background-color: red;
    border-radius: 7px;
}





</style>
