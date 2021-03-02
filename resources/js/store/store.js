
export default {

    state:{
        categories: {}
    },
    getters:{
        getCategories(state){
             return state.categories;
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
        }
    },
    mutations:{
        categories(state, data){
            // console.log(data);
            return state.categories = data;
        }
    }
}
