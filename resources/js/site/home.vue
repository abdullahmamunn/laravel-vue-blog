<template>
<div class="row">
    <div class="col-md-8">
        <h1 class="my-4">
            <small>All Posts</small>
        </h1>
        <!-- Blog Post -->
        <div class="card mb-4" v-for="(post,i) in allPosts.data" :key="post.id">
            <img class="card-img-top" :src="imageUrl(post.thumbnail)" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{post.title}}</h2>
                <p class="card-text">{{post.description}}</p>
                <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
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
    <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
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
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li v-for="category in categories">
                                <a href="#">{{category.name}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">JavaScript</a>
                            </li>
                            <li>
                                <a href="#">CSS</a>
                            </li>
                            <li>
                                <a href="#">Tutorials</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
        </div>

    </div>
</div>
</template>

<script>
    export default {
        name: "home",
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

</style>
