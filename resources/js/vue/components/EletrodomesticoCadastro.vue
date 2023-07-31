<template>
    <div>
        <form ref="formRef" @submit.prevent="formSubmit">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input v-model="data.nome" type="text" class="form-control" id="nome" aria-describedby="nomeHelp">
                <div id="nomeHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea v-model="data.descricao" class="form-control" id="descricao" aria-describedby="descricaoHelp"></textarea>
                <div id="descricaoHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="tensao" class="form-label">Tensão</label>
                <select v-model="data.tensao" class="form-control" id="tensao" aria-describedby="tensaoHelp">
                    <option value="110v">110v</option>
                    <option value="220v">220v</option>
                    <option value="Bivolt">Bivolt</option>
                </select>
                <div id="tensaoHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select v-model="data.marca" class="form-control" id="marca" aria-describedby="marcaHelp">
                    <option v-for="marca in marcas" :key="marca.codigo" :value="marca.codigo" v-text="marca.nome"></option>
                </select>
                <div id="marcaHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Situação</label>
                <select v-model="data.status" class="form-control" id="status" aria-describedby="statusHelp">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
                <div id="statusHelp" class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</template>

<script setup>
import { defineComponent, onMounted, reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import FormErrorHelper from '@/vue/helper/form-error-helper';

defineComponent({
    name: 'EletrodomesticoCadastro'
})

const props = defineProps({
    id: {
        type: Number,
        required: false,
        default: () => 0
    },
    nome: {
        type: String,
        required: false,
        default: () => ""
    },
    descricao: {
        type: String,
        required: false,
        default: () => ""
    },
    tensao: {
        type: String,
        required: false,
        default: () => "110v"
    },
    status: {
        type: String,
        required: false,
        default: () => "ativo"
    },
    marca: {
        type: String,
        required: false,
        default: () => ""
    },
});

const formRef = ref(null);

let formErrorHelper = null;

const data = reactive({
    nome: "",
    descricao: "",
    tensao: "",
    marca: "",
    status: "",
});

const router = useRouter();

const store = useStore();

const marcas = ref([]);

async function formSubmit() {
    let result = null;

    formErrorHelper.cleanErrors();

    if (props.id < 1) {
        result = await store.dispatch('eletrodomestico/insereRegistro', data);
    } else {
        result = await store.dispatch('eletrodomestico/atualizaRegistro', { id: props.id, data });
    }

    if (result.status === 'success') {
        store.dispatch('alert/show', { message: result.message, closeTimeout: 4000 });

        router.push('/');
    } else {
        if (result.messages !== undefined) {
            formErrorHelper.setErrors(result.messages);
        } else {
            store.dispatch('alert/show', { type: 'danger', message: 'Não foi possível salvar o eletrodoméstico', closeTimeout: 4000 });
        }
    }
}

onMounted(async () => {
    const result = await store.dispatch('eletrodomestico/getMarcas');

    if (result.status === 'success') {
        marcas.value = result.data;
    }

    data.nome = props.nome;
    data.descricao = props.descricao;
    data.tensao = props.tensao;
    data.marca = props.marca;
    data.status = props.status.toLowerCase();

    formErrorHelper = new FormErrorHelper(formRef.value, [
        'nome',
        'descricao',
        'tensao',
        'marca',
        'status'
    ]);
})
</script>