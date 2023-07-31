<template>
    <div>
        <EletrodomesticoHome />
    </div>
</template>

<script setup>
import { defineComponent, onMounted } from 'vue';
import EletrodomesticoHome from '@/vue/components/EletrodomesticoHome.vue';

defineComponent({
    name: 'Home',
    components: { EletrodomesticoHome }
});
</script>