<template>
    <nav aria-label="navigation">
        <ul class="pagination">
            <li v-if="showPrevious" class="page-item"><a class="page-link" href="javascript:void(0)" @click="clickPrevious" v-text="labelPrevious"></a></li>

            <li class="page-item" v-for="page in total" :key="`page-${page}`">
                <a v-if="current !== page" class="page-link" href="javascript:void(0)" @click="() => callback(page)" v-text="page"></a>
                <span v-else class="page-link active" v-text="page"></span>
            </li>

            <li v-if="showNext" class="page-item"><a class="page-link" href="javascript:void(0)" @click="clickNext" v-text="labelNext"></a></li>
        </ul>
    </nav>
</template>

<script setup>
import { defineComponent, computed } from 'vue';

defineComponent({
    name: 'Pagination'
});

const props = defineProps({
    current: {
        type: Number,
        required: true,
        default: () => 0
    },
    total: {
        type: Number,
        required: true,
        default: () => 0
    },
    labelPrevious: {
        type: String,
        required: false,
        default: () => "Anterior"
    },
    labelNext: {
        type: String,
        required: false,
        default: () => "Próximo"
    },
    callback: {
        type: Function,
        required: true,
        default: () => (page) => {}
    }
});

const showPrevious = computed(() => props.current > 1);
const showNext = computed(() => props.current < props.total);

function clickPrevious() {
    props.callback(getPrevious());
}

function clickNext() {
    props.callback(getNext());
}

function getPrevious() {
    return props.current - 1;
}

function getNext() {
    return props.current + 1;
}
</script>