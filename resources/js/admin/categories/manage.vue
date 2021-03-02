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
                                <th>
                                    <input :disabled="tableEmpty()" type="checkbox" @click="selectAll" v-model="selectedAll">
                                </th>
                                <th style="width: 10px">SL</th>
                                <th>id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th style="width: 50px">Status</th>
                                <th style="width: 136px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(category,i) in categories.data" :key="category.id">
                                <th style="width: 10px">
                                    <input type="checkbox" :value="category.id" v-model="selected">
                                </th>
                                <td>{{++i}}</td>
                                <td>{{category.id}}</td>
                                <td>{{category.name}}</td>
                                <td>{{category.slug}}</td>
                                <td>{{category.description | subString(10)}}...</td>
                                <td>
                                    {{category.created_at | time}}
                                </td>
                                <td><span class="badge" :class="statusColor(category.status)">{{categoryStatus(category.status)}}</span></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Delete</button>
                                    <router-link :to="{name:'categoryEdit',params:{id: category.id}}" class="btn btn-success btn-sm">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="tableEmpty()">
                               <td colspan="9"> <h4 class="text-center text-danger">Data not found</h4></td>
                            </tr>
                            <button v-if="!tableEmpty()" :disabled="!isSelected" @click="deleteALLItems" class="btn btn-danger btn-sm mx-3"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <pagination
                    :data="categories"
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
                categories: {},
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
                if (_this.selected.length === _this.categories.data.length)
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
            selectAll(event){
              if (event.target.checked === false){
                  this.selected = [];
              }
             else{
                 let _this = this;
                 this.categories.data.forEach(function (category) {
                     _this.selected.push(category.id);
                     // console.log(category.id)
                 })
              }
            },
            getResults(page = 1) {
                axios.get('/categories?page=' + page)
                    .then(response => {
                        toastr.success('welcome to '+page+' page');
                        this.categories = response.data;
                    });
            },
            deleteALLItems(){
                let _this = this;
                axios.post('/delete/all',{data:_this.selected}).then(function (response) {
                    console.log(response.data)
                    _this.getResults()
                }).catch(function (err) {
                    console.log(err)
                });

            }
        }

    }
</script>

<style scoped>

</style>
