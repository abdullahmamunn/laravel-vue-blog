<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                                <select name="category" id="" v-model="form.category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category') }">
                                    <option value="">Select one</option>
                                    <option v-for="category in showCategory" :value="category.id">{{category.name}}</option>
                                </select>
                                <has-error :form="form" field="category"></has-error>
                            </div>
                            <div class="form-group">
                                <label >Description</label>
                                <ckeditor :editor="editor" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></ckeditor>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Thumbnail</label>
                                <input type="file" name="thumbnail" v-on:change="handelFileObject">
                                <img v-if="form.thumbnail" :src="form.thumbnail" alt="photo" width="200">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label mr-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="active" value="published" v-model="form.status" name="status">
                                    <label class="form-check-label" for="">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inActive" value="draft" v-model="form.status">
                                    <label class="form-check-label" for="">InActive</label>
                                </div>
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    const Swal = require('sweetalert2')
    export default {
        name: "add-new",
        data(){
            return{
                form: new Form({
                    title: null,
                    category_id: null,
                    description: null,
                    thumbnail: null,
                    status: null,
                }),
                    editor: ClassicEditor,
                    editorConfig: {
                        // The configuration of the editor.
                    }
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
            handelFileObject(event)
            {
                let image = event.target.files[0];
                let reader = new FileReader;
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.form.thumbnail = e.target.result
                }

            },
            submit(){
                let router = this;
                this.form.post('/create-post').then( (response) =>{
                    console.log(response.data);
                    // router.$router.push({name: 'categories'});
                    // router.$router.push('/categories');
                    Toast.fire({
                        icon: 'success',
                        title: 'Post Created successfully'
                    })
                })
            },
        },


    }
</script>

<style scoped>

</style>
