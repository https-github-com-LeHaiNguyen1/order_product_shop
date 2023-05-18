import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        apiURL: "http://order_laravel_vuejs.local/api",
        serverPath: "http://order_laravel_vuejs.local/",
    },
    mutations: {},
    actions: {},
});
