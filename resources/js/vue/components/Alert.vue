<template>
    <div>
        <div v-if="canShow" class="alert" :class="getClassName">
            {{ message }}
            <button v-if="canClose" type="button" class="btn-close" aria-label="Close" @click="close"></button>
        </div>
    </div>
</template>

<script setup>
import { computed, defineComponent } from 'vue';
import { useStore } from 'vuex';

defineComponent({
    name: 'Alert'
});

const store = useStore();

const message = computed(() => store.state.alert.message);

const type = computed(() => store.state.alert.type);

const timeout = computed(() => store.state.alert.closeTimeout);

const canClose = computed(() => store.state.alert.canClose);

const canShow = computed(() => {
    if (store.state.alert.show === true) {
        closeTimeout();
    }

    return store.state.alert.show;
});

const getClassName = computed(() => {
    let className = `alert-${type.value}`;
    
    if (canClose.value === true) {
        className = className + ' alert-dismissible fade show';
    }

    return className;
});

function close() {
    store.dispatch('alert/hide');
}

function closeTimeout() {
    if (timeout.value > 0) {
        setTimeout(
            () => {
                store.dispatch('alert/hide');
            },
            timeout.value
        );
    }
}
</script>