<template>
   <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">
                <!-- <small>Single Post view {{this.$route.params.id}}</small> -->
                <small>Post Details about {{singlePost.title}}</small>
            </h1>
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                    <h4>{{singlePost.title}}</h4>
                </div>
                <div class="card-body">
                    <div class="img">
                        <img :src="imageUrl(singlePost.thumbnail)" class="img-fluid" alt="">
                    </div>
                    <p v-html="singlePost.description"></p>
                    <!-- <p>{{ singlePost.description }}</p> -->
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
                 singlePost:{}
             }
         },
        mounted() {
             this.singlePostView()
        },
        methods:{
             singlePostView(){
                 const id = this.$route.params.id;
                 axios.get('/single-post/'+id).then((result)=> {
                     // console.log(result.data)
                     this.singlePost = result.data;
                 }).catch((err)=>{
                     console.log(err)
                 })

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
