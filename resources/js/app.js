import router from './vue/route/index'

import {createApp} from 'vue'

import store from './vue/store/index'

import App from './vue/App.vue'

createApp(App).use(store).use(router).mount("#app")