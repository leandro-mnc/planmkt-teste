<template>
    <div>
        <div class="float-start">
            <h3>Lista de Eletrodoméstico</h3>
        </div>

        <div class="float-end mt-1">
            <router-link to="/eletrodomestico/cadastro" class="btn btn-primary">+ Novo Cadastro</router-link>
        </div>

        <div class="mb-5 clear-both"></div>

        <div v-if="hasData">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in apiResult.items" :key="item.id" scope="row">
                        <th v-text="item.nome"></th>
                        <th v-text="item.status"></th>
                        <th>
                            <router-link :to="getLinkEditar(item.id)" class="btn btn-warning btn-sm">Editar</router-link>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-danger btn-sm" @click="actionDelete(item.id)">Deletar</button>
                        </th>
                    </tr>
                </tbody>
            </table>

            <Pagination :current="paginate.current" :total="paginate.total" :callback="paginateCallback" />
        </div>
        <div v-else>
            Nenhum registro encontrado
        </div>
    </div>
</template>

<script setup>
import { computed, defineComponent, onMounted, ref, reactive } from 'vue';
import { useStore } from 'vuex';
import Pagination from '@/vue/components/Pagination.vue';

defineComponent({
    name: 'EletrodomesticoHome',
    components: { Pagination }
});

const store = useStore();

const apiResult = ref(null);

const paginate = reactive({
    current: 0,
    total: 0,
})

const hasData = computed(() => {
    return apiResult.value !== null && apiResult.value.total > 0;
})

function getLinkEditar(id) {
    return '/eletrodomestico/editar/' + id;
}

async function paginateCallback(page) {
    await loadData({ page });
}

async function actionDelete(id) {
    if (window.confirm('Deseja realmente deletar este registro?')) {
        const result = await store.dispatch("eletrodomestico/deletaRegistro", id);

        if (result.status === 'success') {
            store.dispatch('alert/show', { message: result.message, closeTimeout: 4000 });

            // Mantém a página atual, caso tenha mais de 1 registro na página
            if (apiResult.value.items.length > 1) {
                await loadData({ page: paginate.current });
            } else {
                await loadData(null);
            }
        }
    }
}

async function loadData(body) {
    const result = await store.dispatch('eletrodomestico/getLista', body);

    if (result.status === 'success') {
        apiResult.value = result.data;
        paginate.current = result.data.pagina_atual;
        paginate.total = result.data.ultima_pagina;
    }
}

onMounted(async () => {
    await loadData(null);
});
</script>