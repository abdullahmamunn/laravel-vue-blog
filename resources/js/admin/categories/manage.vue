<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control" cols="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label">Status</label>
                                <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="">Active</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                    <label class="form-check-label" for="">InActive</label>
                                </div>
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
    export default {
        name: "manage"
    }
</script>

<style scoped>

</style>
