
export default {

    state:{
        categories: []
    },
    getters:{
        getCategories(state){
             return state.categories;
        }
    },
    actions:{
        getData(data){
           axios.get('categories').then(function (response) {
                // console.log(response.data.categories)
               // this.categories = response.data.categories
               data.commit("categories",response.data.categories)
           })
        }
    },
    mutations:{
        categories(state, data){
            return state.categories = data;
        }
    }
}
