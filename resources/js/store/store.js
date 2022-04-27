
export default {

    state:{
        categories: {},
        activeCategories:{},
        posts:{},
        totalCategories: 0
    },
    getters:{
        getCategories(state){
             return state.categories;
        },
        getActiveCategories(state){
             return state.activeCategories;
        },
        getPosts(state){
            return state.posts;
        }
    },
    actions:{
        getData(data){
           axios.get('/get-categories').then(function (response) {
                // console.log(response.data.length)
               // this_.categories = response.data.categories;
               data.commit('categories',response.data)
           })
        },
        getAllPosts(data){
            axios.get('/all-posts').then(function (response) {
                // console.log(response.data)
                data.commit('allPosts',response.data)
            })
        },
        getActiveCategories(data){
            axios.get('/get-activeCategories').then(function (response) {
                data.commit('activeCategories',response.data)
            })
        }
    },
    mutations:{
        categories(state, data){
            // console.log(data);
            return state.categories = data;
        },
        allPosts(state,data){
            // console.log(data)
            return state.posts = data;
        },
        activeCategories(state,data){
            // console.log(data)
            return state.activeCategories = data;
        }
    }
}
