<template>
    <div class="row">
        <div class="col-md-8">
            <h1 class="my-4">
                <small>Category View</small>
            </h1>
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Category View {{this.$route.params.id}}</h2>
                </div>
               <div class="card-body">
                   <div class="card mb-4" v-for="(post) in CategoryWisePost" :key="post.id">
            <img class="card-img-top" :src="imageUrl(post.thumbnail)" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{post.title}}</h2>
                <sometag v-html=post.description></sometag>
                <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                <b>Posted on</b> {{post.created_at | time}} by
                <a href="#">{{post.user.name}}</a>
            </div>
        </div>
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
                const id = this.$route.params.id;
                axios.get('/category-view/'+id).then((result) => {
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

</style>
