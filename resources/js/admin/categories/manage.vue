<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Categories</h1>
                        <div class="card-tools">
                           <router-link to="/add-new" class="btn btn-primary">Add Category</router-link>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>id</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th style="width: 50px">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category,i) in categories.data" :key="category.id">
                                <td>{{++i}}</td>
                                <td>{{category.id}}</td>
                                <td>{{category.name}}</td>
                                <td>
                                    {{category.created_at | time}}
                                </td>
                                <td><span class="badge" :class="statusColor(category.status)">{{categoryStatus(category.status)}}</span></td>
<!--                                <td v-if="category.status != 0"><span class="badge bg-success">Active</span></td>-->
<!--                                <td v-else><span class="badge bg-danger">InActive</span></td>-->
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Delete</button>
<!--                                    <router-link :to="`edit-category`" class="btn btn-success">Edit</router-link>-->
                                    <router-link :to="{name:'categoryEdit',params:{id: category}}" class="btn btn-success btn-sm">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="tableEmpty()">
                               <td colspan="6"> <h4 class="text-center text-danger">Data not found</h4></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                    <pagination
                        :data="categories"
                        @pagination-change-page="getResults" align="center">
                    </pagination>
                </div>
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
                categories: {},
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
            categoryStatus(status){
               let data = {
                   0: "Inactive",
                   1: "Active"
               };
               return data[status];
            },
            statusColor(status){
                let data = {
                    0: "bg-danger",
                    1: "bg-success"
                };
                return data[status];
            },
            deleteCategory(id){
                axios.get('category-delete/' + id).then((response) =>{
                    // this.$store.dispatch('getData');
                    this.getResults();
                    toastr.success('Category Deleted Success');
                })
            },
            tableEmpty(){
                if(this.categories.data.length < 1)
                {
                    return true;
                }else{
                    return false;
                }

            },
            getResults(page = 1) {
                axios.get('/categories?page=' + page)
                    .then(response => {
                        toastr.success('welcome to '+page+' page');
                        this.categories = response.data;
                    });
            }
        }

    }
</script>

<style scoped>

</style>
