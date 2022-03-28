<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h1 class="card-title">Categories</h1>
                        <div class="card-tools">
                           <router-link to="/add-new" class="btn btn-dark text-light">Add Category</router-link>
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
                                <td>{{category.name}}</td>
                                <td>{{category.slug}}</td>
                                <td :title="category.description">{{category.description | subString(10)}}...</td>
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
                            <tr>
                                <div class="dropdown custom-dropdown">
                                    <button v-if="!tableEmpty()" :disabled="!isSelected"  class="btn btn-danger btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" @click="deleteAllItems">Delete Selected Items</button>
                                        <button class="dropdown-item" @click="statusChange(selected,1)">Active Selected Items</button>
                                        <button class="dropdown-item" @click="statusChange(selected,0)">InActive Selected Items</button>
                                    </div>
                                </div>
                            </tr>
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
                if (_this.selected.data.length === _this.categories.data.length)
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
                this.isConfirm(()=>{
                    axios.get('category-delete/' + id).then((response) =>{
                        // this.$store.dispatch('getData');
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        this.getResults();
                    })
                })

            },
            tableEmpty(){
                if(this.categories.length < 1)
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
            deleteAllItems(){
                    let _this = this;
                    this.isConfirm(()=>{
                    axios.post('category/delete/all',{data:_this.selected}).then(function (response) {
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

                // if(status === 1) {
                //     var msg = 'Activate';
                // }else {
                //     var msg = 'Inactive';
                // }
                let msg = status === 1 ? 'Activated' : 'Deactivated';
                let _this = this;
                axios.post('/category/status-change',{data:selected, status: status}).then(function (response) {
                    _this.selected = [];
                    _this.selectedAll = false;
                    _this.isSelected = false;
                    _this.getResults()
                    // console.log(response.data)
                    toastr.success(response.data.total+" category status "+msg)
                }).catch(function (err) {
                    console.log(err)
                });
                // console.log(selected)
            }
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
