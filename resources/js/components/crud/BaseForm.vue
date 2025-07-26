<script setup lang="ts">
import {Button} from '@/components/ui/button'
import {Link} from '@inertiajs/vue3'

defineProps({
    indexRoute: {
        type: String,
        required: true,
    }
})

</script>

<template>
    <div class="h-full p-4 ">
        <div class="h-full rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <div class="flex justify-end p-4">
                <Link :href="indexRoute">
                    <Button>Voltar</Button>
                </Link>
            </div>
            <div class="p-4">
                <slot name="content" />
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
