<template>
    <div class="my_container overflow-auto">

        <!-- SLIDER CON ANIME IN CORSO -->
        <div class="my_slider">

            <div class="card m-3" style="width: 18rem;">
                <div class="my_img">
                    <span class="my_banner">In corso...</span>
                    <img :src="animeInCorso[counterSlider].cover" class="card-img-top" :alt="animeInCorso[counterSlider].nome">
                </div>                   
            </div>


            <div class="card m-3" style="width: 18rem;">
                <div class="my_img">
                    <span class="my_banner">In corso...</span>
                    <img :src="animeInCorso[counterSlider1].cover" class="card-img-top" :alt="animeInCorso[counterSlider1].nome">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{animeInCorso[counterSlider1].nome}}</h5>
                    <!-- <p class="card-text">{{getTroncateText(animeInCorso[counterSlider].content, 100) + '...'}}</p> -->

                    <div class="mb-3">
                        <i v-for="(n, index) in 5" :key="index" class="fa-star" :class="(n<=animeInCorso[counterSlider1].vote)?'fa-solid':'fa-regular'"></i>
                    </div>
                    
                    <router-link class="my_button" :to="{name: 'anime', params: {slug: animeInCorso[counterSlider1].slug}}" title="Maggiori dettagli">Vedi</router-link>
                </div>
            </div>

            <div class="card m-3" style="width: 18rem;">
                <div class="my_img">
                    <span class="my_banner">In corso...</span>
                    <img :src="animeInCorso[counterSlider2].cover" class="card-img-top" :alt="animeInCorso[counterSlider2].nome">
                </div>
            </div>

            <!-- direzzioni slider -->
            <div class="my_direction">

                <div class="right" @click="left()">
                    <i class="fa-solid fa-chevron-right fa-lg"></i>
                </div>

                <div class="left" @click="right()">
                    <i class="fa-solid fa-chevron-left fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="my_pagination">
            <i class="fa-solid fa-chevron-left fa-lg my_number_button"  @click="getAnime(paginaCorrente -1)"></i>

            <div class="my_number_button" @click="getAnime(paginaCorrente = index+1)" :class="(index==paginaCorrente-1)?'active_paginate':''" v-for="(n, index) in ultimaPagina" :key="index">
                {{index +1}}
            </div>
            
            <i class="fa-solid fa-chevron-right fa-lg my_number_button" :class="(paginaCorrente==ultimaPagina)?'hidden':''" @click="getAnime(paginaCorrente +1)"></i>
        </div>

        <!-- ANIME VISTI COMPLETAMENTE -->
        <div class="container d-flex flex-wrap justify-content-center">

            <div class="card m-3" style="width: 18rem;" v-for="(anim, index) in anime" :key="index">
                <div class="my_img">
                    <span class="my_banner">Completato</span>
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
                animeInCorso: [],
                counterSlider: 0,
                counterSlider1: 1,
                counterSlider2: 2,
                
                paginaCorrente: 1,
                ultimaPagina: null,
            }
        },
        methods:{
            getAnime(page){
                axios.get('/api/anime', {
                    params:{
                        page: page,
                    }
                })
                .then(res=>{
                    this.anime = res.data.results.data;
                    this.animeInCorso = res.data.secondResults;

                    this.paginaCorrente = res.data.results.current_page
                    this.ultimaPagina = res.data.results.last_page
                    console.log(this.paginaCorrente + 'pagina corrente');
                    console.log(this.ultimaPagina + 'ultima pagina');
                })
            },
            getTroncateText(text, numCar){
                return text.slice(0, numCar);
            },

            /* direzione slider */
            right(){
                /* 0 */
                if(this.counterSlider == this.animeInCorso.length -1){
                    this.counterSlider = 0
                }else{
                    this.counterSlider++
                }

                /* 1 */
                if(this.counterSlider1 == this.animeInCorso.length -1){
                    this.counterSlider1 = 0
                }else{
                    this.counterSlider1++
                }

                /* 2 */
                if(this.counterSlider2 == this.animeInCorso.length -1){
                    this.counterSlider2 = 0
                }else{
                    this.counterSlider2++
                }
            },
            left(){
                /* 0 */
                if(this.counterSlider == 0){
                    this.counterSlider = this.animeInCorso.length - 1
                }else{
                    this.counterSlider--
                }

                /* 1 */
                if(this.counterSlider1 == 0){
                    this.counterSlider1 = this.animeInCorso.length - 1
                }else{
                    this.counterSlider1--
                }

                /* 2 */
                if(this.counterSlider2 == 0){
                    this.counterSlider2 = this.animeInCorso.length - 1
                }else{
                    this.counterSlider2--
                }
            },
        },
        mounted(){
            this.getAnime(this.paginaCorrente);
        },

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
            position: relative;
            img{
                height: 100%;
                object-fit: cover;
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
        }
        .my_slider{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            position: relative;
            border-radius: 10px;
            border: 1px solid white;
        }

        .right, .left{
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            height: 45px;
            width: 45px;
            border-radius: 50%;
            padding: 10px;
            background-color: white;
            opacity: 0.7;
            transform: traslate(-50%, -50%);
            
            &:hover{
                opacity: 1;
            }

            &:active{
                transform: scale(0.9);
            }
        }

        .right{
            top: 50%;
            right: 2%;
        }

        .left{
            top: 50%;
            left: 2%;
        }

.my_pagination{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 20px 0;

    .my_number_button{
        color: white;
        height: 30px;
        width: 30px;
        line-height: 30px;
        text-align: center;
        border: 1px solid white;
        margin-right: 5px;

        &:active{
            transform: scale(0.9);
        }
    }
}

.active_paginate{
    color: black !important;
    background-color: white;
    font-weight: bolder;
}

.hidden{
    visibility: hidden;
}

</style>
