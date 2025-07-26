<script setup lang="ts">

import {Link} from "@inertiajs/vue3";
import {Button} from "@/components/ui/button";
import {SquarePen} from "lucide-vue-next";

defineProps({
    route: {
        type: String,
        required: true,
    }
})

</script>

<template>
    <Link :href="route">
        <Button size="icon" title="Editar">
            <slot name="icon">
                <SquarePen />
            </slot>
        </Button>
    </Link>
</template>

<style scoped>

</style>
