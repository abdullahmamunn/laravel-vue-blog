import Vue from "vue";
Vue.mixin({
    methods:{
        isConfirm:function (callback) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if(result.value) callback();
            })
        },
        imageUrl(url){
            if(url!=null && url.length > 255)
            {
                console.log(url.length)
                return this.form.thumbnail;
            }
            else{
                return 'uploads/posts/' + url;
            }

        }
    }
})
