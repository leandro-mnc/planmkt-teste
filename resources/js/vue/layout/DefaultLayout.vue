<template>
    <header class="header">
        <div class="container">
            <router-link to="/">
                <img src="/images/logo-plan.png" class="logo"/>
            </router-link>
        </div>
    </header>

    <div class="container mt-5">
        <alert />

        <slot />
    </div>
</template>

<script setup>
import { defineComponent } from 'vue';
import Alert from '@/vue/components/Alert.vue';

defineComponent({
    name: 'DefaultLayout',
    components: { Alert }
});
</script>