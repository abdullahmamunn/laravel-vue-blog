<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category{{this.$route.params.id}}</h3>
                    </div>
                    <form @submit.prevent="updateCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Category Name" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label >Description</label>
                                <textarea class="form-control" cols="5" placeholder="Description" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }">
                                </textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label mr-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="active" value="1" v-model="form.status" name="status">
                                    <label class="form-check-label" for="">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inActive" value="0" v-model="form.status">
                                    <label class="form-check-label" for="">InActive</label>
                                </div>
                                <span :class="{ 'is-invalid': form.errors.has('description') }"></span>
                                <has-error :form="form" field="status"></has-error>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    const Swal = require('sweetalert2')
    export default {
        name: "add-new",
        data(){
            return{
                form: new Form({
                    name: null,
                    description: null,
                    status: null,
                }),
            }
        },
        methods:{
            updateCategory(){
                let _this = this;
                this.form.post('/update-category/'+this.$route.params.id).then(function (response) {
                    console.log(response.data);
                    _this.$router.push({name:'categories'})
                    toastr.success("Category Updated Successfully")
                }).catch(function (error) {
                    console.log(error)
                })
            },
            getCategory(){
               const _this = this;
                axios.get('/get-category/'+this.$route.params.id).then(function (response) {
                    _this.form.fill(response.data);
                    // console.log(response.data);
                }).catch(function (error) {
                    console.log(error)
                })
            }
        },
        mounted() {
          this.getCategory()
        }
    }
</script>

<style scoped>

</style>
