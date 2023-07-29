import { Store } from 'vuex';

import Eletrodomestico from './eletrodomestico';

const store = new Store({
    state: {},
    mutations: {},
    getters: {},
    actions: {},
    modules: {
       eletrodomestico: Eletrodomestico
    }
})

export default store;
