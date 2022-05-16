<template>
    <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
            <h1 class="my-3 mt-3 text-center"><small>Get In Tuch</small></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <form @submit.prevent="submit()">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label for="">Name</label>
                            <input type="text" class="form-control" v-model="form.name" name="name" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="">Email</label>
                            <input type="email" class="form-control" v-model="form.email" name="email" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Message</label>
                            <textarea class="form-control" cols="10" rows="5" v-model="form.message" name="message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                            <has-error :form="form" field="message"></has-error>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "contact",
        data(){
            return{
                 form: new Form({
                    name: null,
                    email: null,
                    message: null,
                })
            }
        },
        methods:{
            submit(){
                let router = this
                    this.form.post('/contact').then(function (data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Thank You! For information'
                    })
                })
                this.form.clear();
            }
        }
    }
</script>

<style scoped>

</style>
