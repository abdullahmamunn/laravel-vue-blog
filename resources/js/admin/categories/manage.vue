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
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th style="width: 50px">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category,i) in getResult">
                                <td>{{++i}}</td>
                                <td>{{category.name}}</td>
                                <td>
                                    {{category.created_at | time}}
                                </td>
                                <td><span class="badge" :class="statusColor(category.status)">{{categoryStatus(category.status)}}</span></td>
<!--                                <td v-if="category.status != 0"><span class="badge bg-success">Active</span></td>-->
<!--                                <td v-else><span class="badge bg-danger">InActive</span></td>-->
                                <td>
                                    <button class="btn btn-danger" @click="deleteCategory(category.id)">Delete</button>
                                    <router-link to="/edit-category" class="btn btn-success">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="tableEmpty()">
                               <td colspan="6"> <h4 class="text-center text-danger">Data not found</h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "manage",
        mounted() {
            this.$store.dispatch('getData')
        },
        computed:{
           getResult(){
               return this.$store.getters.getCategories
           }
        },
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
                    this.$store.dispatch('getData');
                    toastr.success('Category Deleted Success');
                })
            },
            tableEmpty(){
               if (this.getResult.length < 1){
                   return true;
               }
               else{
                   return false;
               }
            }

        }
    }
</script>

<style scoped>

</style>
