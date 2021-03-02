<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New Post</h3>
                    </div>
                    <form @submit.prevent="submit()">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Post title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category" id="" class="form-control">
                                    <option value="">Select one</option>
                                    <option v-for="category in showCategory" :value="category.id">{{category.name}}</option>
                                </select>
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label >Content</label>
                                <textarea class="form-control" cols="5" placeholder="Description" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }">
                                </textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Thumbnail</label>
                                <input type="file">
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
    import categories from "./manage";

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
        mounted() {
            this.$store.dispatch('getData');
        },
        computed:{
            showCategory()
            {
                return this.$store.getters.getCategories
            }
        },
        methods:{
            submit(){
                let router = this
                this.form.post('/add-category').then(function (data) {
                    // router.$router.push({name: 'categories'});
                    router.$router.push('/categories');
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: 'Category Added successfully'
                    // })
                    Command: toastr["success"]("Category Added", "Success")
                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    this.form.clear()
                })
            },
        },

    }
</script>

<style scoped>

</style>
