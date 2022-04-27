<template>
    <div class="row">
        <div class="col-md-8">
            <h1 class="my-4">
                <!-- <small>Single Post view {{this.$route.params.id}}</small> -->
                <small>Single Post view</small>
            </h1>
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                    <h4>Title: {{singlePost.title}}</h4>
                </div>
                <div class="card-body">
                    <img :src="imageUrl(singlePost.thumbnail)" alt="">
                    <p v-html="singlePost.description"></p>
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
</style>
