<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post{{this.$route.params.id}}</h3>
                    </div>
                    <form @submit.prevent="updatePost()">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Post Title</label>
                                <input type="text" class="form-control" placeholder="Post Title" v-model="form.title" name="title" :class="{ 'is-invalid': form.errors.has('title') }">
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
                                <input type="file" name="thumbnail" v-on:change="handelFileObject($event)">
                                <img :src="imageUrl(form.thumbnail)" alt="photo" width="200px">
<!--                                {{form.thumbnail}}-->
                            </div>
                            <div class="form-group">
                                <label class="col-form-label mr-3">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="active" value="published" v-model="form.status" name="status">
                                    <label class="form-check-label" for="">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inActive" value="draft" v-model="form.status">
                                    <label class="form-check-label" for="">Draft</label>
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

    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    const Swal = require('sweetalert2')
    export default {
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
            this.getPost()
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
            updatePost(){
                let _this = this;
                this.form.post('/update-post/'+this.$route.params.id).then(function (response) {
                    console.log(response.data);
                    // _this.$router.push({name:'categories'})
                    toastr.success("Category Updated Successfully")
                }).catch(function (error) {
                    console.log(error)
                })
            },
            getPost(){
               const _this = this;
                axios.get('/get-post/'+this.$route.params.id).then(function (response) {
                    _this.form.fill(response.data);
                    console.log(response.data);
                }).catch(function (error) {
                    console.log(error)
                })
            },

        },

    }
</script>

<style scoped>

</style>
