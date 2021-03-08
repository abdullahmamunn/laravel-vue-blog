
export default {

    state:{
        categories: {},
        posts:{},
    },
    getters:{
        getCategories(state){
             return state.categories;
        },
        getPosts(state){
            return state.posts;
        }
    },
    actions:{
        getData(data){
            let this_ = this;
           axios.get('/get-categories').then(function (response) {
                // console.log(response.data)
               // this_.categories = response.data.categories;
               data.commit("categories",response.data)
           })
        },
        getAllPosts(data){
            axios.get('/all-posts').then(function (response) {
                data.commit('allPosts',response.data)
            })
        }
    },
    mutations:{
        categories(state, data){
            // console.log(data);
            return state.categories = data;
        },
        allPosts(state,data){
            console.log(data)
            return state.posts = data;
        }
    }
}
