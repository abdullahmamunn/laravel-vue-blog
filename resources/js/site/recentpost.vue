<template>
   <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">
                <!-- <small>Single Post view {{this.$route.params.id}}</small> -->
                <small>Recent Post Details {{recentPost.title}}</small>
            </h1>
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                    <h4>{{recentPost.title}}</h4>
                </div>
                <div class="card-body">
                     <div class="img">
                        <img :src="imageUrl(recentPost.thumbnail)" class="img-fluid" alt="">
                    </div>
                    <p v-html="recentPost.description"></p>
                </div>
            </div>
        </div>
    </div>
   </div>
</template>

<script>
    export default {
         data(){
             return{
                 recentPost:[]
             }
         },
        mounted() {
             this.recentPostView()
        },
        methods:{
             recentPostView(){
                const slug = this.$route.params.slug
                 axios.get('/recent-post/'+slug).then((result) => {
                    // console.log(result.data);
                    this.recentPost = result.data
                }).catch((err) => {
                    console.log(err);
                });
             }
        }
    }
</script>

<style scoped>
    .custom-col{
        margin-top: 71px;
    }
    .img{
        width: 100%;
        height: auto;
        text-align: center;
    }
</style>
