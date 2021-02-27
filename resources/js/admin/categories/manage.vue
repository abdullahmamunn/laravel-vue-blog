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
                            <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
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
        data(){
            return{
                categories:{},
                data:{}
            }
        },
        created() {
            // Simple GET request using fetch
            fetch("https://api.npms.io/v2/search?q=vue")
                .then(response => response.json())
                .then(data => (this.totalVuePackages = data.total));
        },
        methods:{
            // getCategories(){
            //    fetch('/categories').then(function (response) {
            //         this.categories = response.data;
            //         // console.log(response.data)
            //     })
            // }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
