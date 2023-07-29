<template>
    <header class="header">
        <div class="container">
            <router-link to="/">
                <img src="/images/logo-plan.png" class="logo"/>
            </router-link>
        </div>
    </header>

    <div class="container mt-5">
        <slot />
    </div>
</template>

<script setup>
import { defineComponent } from 'vue';

defineComponent({
    name: 'DefaultLayout'
})
</script>