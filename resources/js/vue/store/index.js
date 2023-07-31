import { Store } from 'vuex';

import Alert from './alert';
import Eletrodomestico from './eletrodomestico';

const store = new Store({
    state: {},
    mutations: {},
    getters: {},
    actions: {},
    modules: {
       alert: Alert,
       eletrodomestico: Eletrodomestico
    }
});

export default store;
