<script setup lang="ts">
import {Button} from "@/components/ui/button";
import {UserCheck} from "lucide-vue-next";
import {router} from "@inertiajs/vue3";
import BaseAlertDialog from "@/components/BaseAlertDialog.vue";
import {toast} from "vue-sonner";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    }
})

function inactivateUser() {
    const options = {
        onSuccess: () => toast(`Usuário ativado.`),
        preserveScroll: true,
    };
    router.patch(route('users.activate', props.user), {}, options)
}

</script>

<template>
    <BaseAlertDialog description="Esta ação ativa o cadastro deste usuário e permite o seu acesso ao sistema."
                     :handler="inactivateUser">
        <template #trigger>
            <Button variant="secondary" size="icon" title="Ativar">
                <UserCheck />
            </Button>
        </template>
    </BaseAlertDialog>
</template>
