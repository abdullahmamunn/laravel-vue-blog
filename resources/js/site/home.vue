<template>
<div class="row">
    <div class="col-md-8">
        <h1 class="my-4">
            <small>All Posts</small>
        </h1>
        <div class="card mb-4" v-for="post in allPosts.data" :key="post.id">
            <clazy-load class="wrapper" @load="log" :src="imageUrl(post.thumbnail)">
                <transition name="fade">
                    <img :src="imageUrl(post.thumbnail)" alt="Card image cap">
                </transition>
                <transition name="fade" slot="placeholder">
                    <div class="preloader">
                        <div class="circle">
                            <div class="circle-inner"></div>
                        </div>
                    </div>
                </transition>
            </clazy-load>
            <div class="card-body">
                <h2 class="card-title">{{post.title}}</h2>
                <b v-if="post.category != null">Category: {{post.category.name}}</b>
                <b v-else>Category: uncategorize</b>
                <br>
                <br>
                <p>{{post.description | striphtml |subString(300)}}..</p>
<!--                <router-link :to="{ path: 'home' }">Home</router-link-->
                <router-link :to="{name:'singlePost',params: {id:post.id}}" class="btn btn-dark float-right">Read More &rarr;</router-link>
            </div>
            <div class="card-footer custom-footer text-muted">
                <b>Posted on</b> {{post.created_at | time}} by
                <a href="#">{{post.user.name}}</a>
            </div>
        </div>
        <!-- Pagination -->
        <pagination
            :data="allPosts"
            @pagination-change-page="getResults" align="center">
        </pagination>

    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4 custom-col">

        <!-- Search Widget -->
        <div class="card">
            <h5 class="card-header bg-dark text-light">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                </div>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header bg-dark text-light">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul v-for="category in categories" :key="category.id" class="list-unstyled custom-ul-a mb-0">
                            <li class="text-dark">
                                <router-link :to="{name:'categoryShow',params:{slug:category.slug}}">{{category.name}}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            <h5 class="card-header bg-dark text-light">Side Widget</h5>
            <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
        </div>

    </div>
</div>
</template>

<script>
    import { VueClazyLoad } from 'vue-clazy-load'
    export default {
        name: "home",
        props:[
           'src'
        ],
        components: {
            VueClazyLoad
        },
        data(){
            return{
                 allPosts:{},
            }
        },
        mounted() {
            this.$store.dispatch('getActiveCategories');
            this.getResults()
        },
        computed:{
            categories()
            {
               return this.$store.getters.getActiveCategories;
            }
        },
        methods:{
            log() {
                console.log('loaded')
            },
            getResults(page = 1) {
                axios.get('/all-posts?page=' + page)
                    .then(response => {
                        // toastr.success('welcome to '+page+' page');
                        this.allPosts = response.data;
                    });
            },
        }

    }
</script>

<style scoped>
    .custom-col{
            margin-top: 94px;
    }
    .custom-footer{
        background: none !important;
    }
    .custom-ul-a li a{
        color: #343a40;
        text-decoration: none;
    }
    .custom-ul-a li a:hover{
        background: #343a40;
        color: white;
    }
    .wrapper {
        flex: 1 0 33.333%;
        position: relative;
        padding-bottom: 21.333vw;
    }

    .wrapper img {
        position: absolute;
        width: 100%;
        height: 100%;
        transition: all 250ms ease-out;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
        transform: scale(.8);
    }

    /* preloader source: https://codepen.io/Alex-Miller/pen/qviHa */
    .preloader {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -25px 0 0 -25px;
        width: 50px;
        height: 50px;
        transition: all 100ms ease-in;
    }

    .preloader .circle,
    .preloader .circle .circle-inner {
        width: inherit;
        height: inherit;
        border-radius: 50%;
        background: linear-gradient(rgba(64, 150, 238, 1) -50%,rgba(64, 150, 238, 0) 60%);
    }

    .preloader .circle {
        animation: roll 6s linear infinite;
    }

    .preloader .circle .circle-inner {
        padding: 5px;
        animation: roll 2s linear infinite reverse;
    }

    .preloader .circle .circle-inner::after {
        content: '';
        display: block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
    }

    @keyframes roll {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }


</style>
