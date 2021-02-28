<template>
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-8">
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
                                <th>Description</th>
                                <th style="width: 40px">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category,i) in getResult">
                                <td>{{++i}}</td>
                                <td>{{category.name}}</td>
                                <td>
                                    {{category.description}}
                                </td>
                                <td>{{category.status}}<span class="badge bg-danger"></span></td>
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
    }
</script>

<style scoped>

</style>
