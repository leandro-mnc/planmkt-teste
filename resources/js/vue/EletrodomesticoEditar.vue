<template>
    <div>
        <div class="mb-5">
            <h1>Editar Eletrodoméstico</h1>
        </div>

        <Cadastro v-if="cadastroLoaded" :id="data.id" :nome="data.nome" :descricao="data.descricao" :tensao="data.tensao" :marca="data.marca" :status="data.status" />
    </div>
</template>

<script setup>
import { defineComponent, onMounted, reactive, ref, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useStore } from 'vuex';
import Cadastro from '@/vue/components/EletrodomesticoCadastro.vue';

defineComponent({
    name: 'EletrodomesticoEditar',
    components: { Cadastro }
});

const route = useRoute();
const router = useRouter();

const store = useStore();

const isLoaded = ref(false);

const data = reactive({
    id: 0,
    nome: "",
    descricao: "",
    tensao: "110v",
    marca: "",
    status: "ativo",
});

const cadastroLoaded = computed(() => isLoaded.value);

onMounted(async () => {
    const result = await store.dispatch('eletrodomestico/getEditar', route.params.id);

    if (result.status === 'success') {
        data.id = result.data.id;
        data.nome = result.data.nome;
        data.descricao = result.data.descricao;
        data.tensao = result.data.tensao;
        data.marca = result.data.marca;
        data.status = result.data.status;
        isLoaded.value = true;
    } else {
        router.push('/');
    }
});
</script>