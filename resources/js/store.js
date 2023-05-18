import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        apiURL: "http://order_plading_page.local/api",
        serverPath: "http://order_plading_page.local/",
    },
    mutations: {},
    actions: {},
});
