<template>
    <div>
        <div class="mb-5">
            <h1>Cadastrar Eletrodoméstico</h1>
        </div>

        <Cadastro />
    </div>
</template>

<script setup>
import { defineComponent } from 'vue';
import Cadastro from '@/vue/components/EletrodomesticoCadastro.vue'

defineComponent({
    name: 'EletrodomesticoCadastro',
    components: { Cadastro }
})
</script>