import { createRouter, createWebHistory } from 'vue-router'

import DefaultLayout from '@/vue/layout/DefaultLayout.vue'
import Home from '@/vue/Home.vue'
import EletrodomesticoCadastro from '@/vue/EletrodomesticoCadastro.vue'
import EletrodomesticoEditar from '@/vue/EletrodomesticoEditar.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        meta: {
            layout: DefaultLayout
        },
        component: Home
    },
    {
        path: '/eletrodomestico/cadastro',
        name: 'Cadastro de Eletrodoméstico',
        meta: {
            layout: DefaultLayout
        },
        component: EletrodomesticoCadastro
    },
    {
        path: '/eletrodomestico/editar/:id',
        name: 'Editar de Eletrodoméstico',
        meta: {
            layout: DefaultLayout
        },
        component: EletrodomesticoEditar
    },
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})

export default router;