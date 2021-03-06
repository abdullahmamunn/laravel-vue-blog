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
                                <th>
                                    <input :disabled="tableEmpty()" type="checkbox" @click="selectAll" v-model="selectedAll">
                                </th>
                                <th style="width: 10px">SL</th>
                                <th>id</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Thumbnail</th>
                                <th>Posted by</th>
                                <th>Status</th>
                                <th style="width: 136px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post,i) in posts.data" :key="post.id">
                                <td>
                                    <input type="checkbox" :value="post.id" v-model="selected">
                                </td>
                                <td>{{++i}}</td>
                                <td>{{post.id}}</td>
                                <td v-if="post.category.name === null">''</td>
                                <td v-else>{{post.category.name}}</td>
                                <td>{{post.title | subString(10)}}...</td>
                                <td>{{post.description | subString(10)}}...</td>
                                <td>
                                    <img :src="imageUrl(post.thumbnail)" height="50" alt="title-image">
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
                            <tr>
                                <div class="dropdown custom-dropdown">
                                    <button v-if="!tableEmpty()" :disabled="!isSelected"  class="btn btn-danger btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" @click="deleteAllItems">Delete Selected Items</button>
                                        <button class="dropdown-item" @click="statusChange(selected,'published')">Published Selected Items</button>
                                        <button class="dropdown-item" @click="statusChange(selected,'draft')">Draft Selected Items</button>
                                    </div>
                                </div>
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
                selected:[],
                selectedAll: false,
                isSelected: false
            }
        },

        mounted() {
            // Fetch initial results
            // this.$store.dispatch('getData');
            this.getResults();
        },
        watch:{
            selected(){
                let _this = this;
                _this.isSelected = (_this.selected.length>0);
                if (_this.selected.length === _this.posts.data.length)
                {
                    _this.selectedAll = true
                }
                else {
                    _this.selectedAll = false
                }
            }
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
                this.isConfirm(()=>{
                    axios.get('post-delete/' + id).then((response) =>{
                        // console.log(response.data)
                        toastr.success('Post Deleted Successfully');
                        this.getResults();
                    })
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
            selectAll(event){
                const _this = this;
                if (event.target.checked === false){
                    _this.selected = [];
                }
                else{
                    _this.posts.data.forEach(function (post) {
                        _this.selected.push(post.id);
                        // console.log(category.id)
                    })
                }
            },
            getResults(page = 1) {
                axios.get('/posts?page=' + page)
                    .then(response => {
                        // toastr.success('welcome to '+page+' page');
                        this.posts = response.data;
                    });
            },
            deleteAllItems(){
                let _this = this;
                this.isConfirm(()=>{
                    axios.post('post/delete/all',{data:_this.selected}).then(function (response) {
                        console.log(response.data)
                        _this.selected = [];
                        _this.selectedAll = false;
                        _this.isSelected = false;
                        _this.getResults()
                        toastr.success(response.data.total_deleted+' Category deleted')
                    }).catch(function (err) {
                        console.log(err)
                    });
                })
            },
            statusChange(selected,status) {
                let msg = status === 'published' ? 'Published' : 'Draft';
                let _this = this;
                axios.post('/posts/status-change',{data:selected, status: status}).then(function (response) {
                    _this.selected = [];
                    _this.selectedAll = false;
                    _this.isSelected = false;
                    _this.getResults()
                    // console.log(response.data)
                    toastr.success(response.data.total+" Post status "+msg)
                }).catch(function (err) {
                    console.log(err)
                });
                // console.log(selected)
            },

        }

    }
</script>

<style scoped>
    .custom-dropdown{
        margin-left: 12px;
        padding-bottom: 7px;
    }
    .custom-dropdown-menu{
        position: absolute!important;
        will-change: transform!important;
        top: 6px!important;
        left: -15px!important;
        transform: translate3d(0px, 28px, 0px)!important;
    }
</style>
