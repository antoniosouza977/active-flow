<script setup lang="ts">

import {ref} from "vue";
import {Input} from "@/components/ui/input";
import axios from "axios";

const props = defineProps({
    placeholder: {
        type: String,
        required: true,
    },
    route: {
        type: String,
        required: true,
    }
})

const emit = defineEmits(['search:complete'])
const search = ref('')

let debounceTimeout: ReturnType<typeof setTimeout> | null = null;

function handleInput() {
    if (debounceTimeout) {
        clearTimeout(debounceTimeout);
    }

    debounceTimeout = setTimeout(() => {
        axios.get(props.route, {
            params: {
                search: search.value
            }
        }).then(response => {
            emit('search:complete', response.data)
        })
    }, 500);
}
</script>

<template>
    <Input type="text" :placeholder="placeholder" v-model="search" @input="handleInput"/>
</template>

<style scoped>

</style>
