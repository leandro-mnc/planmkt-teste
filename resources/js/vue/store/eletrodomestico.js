import { RequestHelper } from '@/vue/helper/request-helper';

const Eletrodomestico = {
    namespaced: true,
    state: {},
    mutations: {},
    actions: {
        async getLista({}, data) {
            return await RequestHelper.getJson('/api/eletrodomestico', data);
        },
        async getEditar({}, id) {
            return await RequestHelper.getJson('/api/eletrodomestico/' + id + '/edit', null);
        },
        async insereRegistro({}, data) {
            return await RequestHelper.postJson('/api/eletrodomestico', data);
        },
        async atualizaRegistro({}, data) {
            return await RequestHelper.putJson('/api/eletrodomestico/' + data.id, data.data);
        },
        async deletaRegistro({}, id) {
            return await RequestHelper.deleteJson('/api/eletrodomestico/' + id, null);
        },
        async getMarcas({}) {
            return await RequestHelper.getJson('/api/marca', null);
        },
    },
    getters: { }
};

export default Eletrodomestico;