<template>
    <div class="row">
        <div class="col-md-8">
            <h1 class="my-4">
                <small>Category wise view</small>
            </h1>
           <div v-if="CategoryWisePost!=null">
               <div class="card mb-4" v-for="(post) in CategoryWisePost" :key="post.id">
                   <clazy-load class="wrapper" :src="imageUrl(post.thumbnail)">
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
                       <router-link :to="{name:'singlePost', params:{id:post.id}}" class="btn btn-dark float-right">Read More &rarr;</router-link>
                   </div>
                   <div class="card-footer custom-footer text-muted">
                       <b>Posted on</b> {{post.created_at | time}} by
                       <a href="#">{{post.user.name}}</a>
                   </div>
               </div>
           </div>
           <div else>
               <div class="card">
                 <h1 style="margin-top:250px; text-align:center;width:70%;">Categorywise Data Not Found!</h1>
               </div>
           </div>

        </div>
        <div class="col-md-4 custom-col">
                <div class="card my-4">
                    <h5 class="card-header bg-dark text-light">Recent Posts</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "about",
        data(){
            return{
                CategoryWisePost:{}
            }
        },
        mounted(){
          this.CategoryView();
        },
        methods: {
            CategoryView(){
                const slug = this.$route.params.slug;
                axios.get('/category-view/'+slug).then((result) => {
                    // console.log(result.data);
                    this.CategoryWisePost = result.data
                }).catch((err) => {
                    console.log(err);
                });
            }
        },

    }
</script>

<style scoped>
     .custom-footer{
         background: none !important;
     }
    .custom-col{
        margin-top: 71px;
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
