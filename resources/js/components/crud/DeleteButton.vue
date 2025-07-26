<script setup lang="ts">
import {Button} from "@/components/ui/button";
import {Trash} from "lucide-vue-next";
import {router} from "@inertiajs/vue3";
import BaseAlertDialog from "@/components/BaseAlertDialog.vue";
import {toast} from "vue-sonner";

const props = defineProps({
    record: {
        type: Object,
        required: true,
    },
    routePrefix: {
        type: String,
        required: true,
    },
    recordLabel: {
        type: String,
        required: true,
    }
})

function destroy() {
    const options = {
        onSuccess: () => toast(`${props.recordLabel} removido com sucesso.`),
        preserveScroll: true,
    };
    router.delete(route(`${props.routePrefix}.destroy`, props.record), options)
}

</script>

<template>
    <BaseAlertDialog :description="'Esta ação remover o registro deste(a) ' + props.recordLabel + ' permanentemente do sistema.'"
                     :handler="destroy">
        <template #trigger>
            <Button variant="destructive" size="icon" title="Inativar">
                <slot name="icon">
                    <Trash />
                </slot>
            </Button>
        </template>
    </BaseAlertDialog>
</template>
