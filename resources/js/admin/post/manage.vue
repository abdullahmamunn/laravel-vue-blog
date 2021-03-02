<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Manage Posts</h1>
                        <div class="card-tools">
                           <router-link to="/create-post" class="btn btn-primary">Add new post</router-link>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th style="width: 10px">SL</th>
                                <th>id</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Thumbnail</th>
                                <th>Posted by</th>
                                <th style="width: 50px">Status</th>
                                <th style="width: 136px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post,i) in posts.data" :key="post.id">
                                <td>{{++i}}</td>
                                <td>{{post.id}}</td>
                                <td>{{post.category.name}}</td>
                                <td>{{post.title | subString(10)}}...</td>
                                <td>{{post.content | subString(10)}}...</td>
                                <td>
                                    <img :src="post.thumbnail" width="60" alt="">
                                </td>
                                <td>{{post.user.name}}</td>
                                <td>
                                    <span class="badge" :class="statusColor(post.status)">{{post.status | capitalize}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="deletePost(post.id)">Delete</button>
                                    <router-link :to="{name:'postEdit',params:{id: post.id}}" class="btn btn-success btn-sm">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="tableEmpty()">
                               <td colspan="9"> <h4 class="text-center text-danger">Data not found</h4></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <pagination
                    :data="posts"
                    @pagination-change-page="getResults" align="center">
                </pagination>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "manage",
        data() {
            return {
                // Our data object that holds the Laravel paginator data
                posts: {},
            }
        },

        mounted() {
            // Fetch initial results
            // this.$store.dispatch('getData');
            this.getResults();
        },
        // computed:{
        //    getResult(){
        //        return this.$store.getters.getCategories
        //    }
        // },
        methods:{
            statusColor(status){
                let data = {
                    draft: "bg-danger",
                    published: "bg-success"
                };
                return data[status];
            },
            deletePost(id){
                toastr.success(id);
                axios.get('post-delete/' + id).then((response) =>{
                    // console.log(response.data)
                    this.getResults();
                    toastr.success('Post Deleted Successfully');
                })
            },
            tableEmpty(){
                if(this.posts.data.length < 1)
                {
                    return true;
                }else{
                    return false;
                }

            },
            getResults(page = 1) {
                axios.get('/posts?page=' + page)
                    .then(response => {
                        // toastr.success('welcome to '+page+' page');
                        this.posts = response.data;
                    });
            }
        }

    }
</script>

<style scoped>

</style>
