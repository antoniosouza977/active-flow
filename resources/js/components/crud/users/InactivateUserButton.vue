<script setup lang="ts">
import {Button} from "@/components/ui/button";
import {UserX} from "lucide-vue-next";
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
        onSuccess: () => toast(`Usuário inativado.`),
        preserveScroll: true,
    };
    router.patch(route('users.inactivate', props.user), {}, options)
}

</script>

<template>
    <BaseAlertDialog description="Esta ação desativa o cadastro deste usuário e impedirá o seu acesso ao sistema."
                     :handler="inactivateUser">
        <template #trigger>
            <Button variant="destructive" size="icon" title="Inativar">
                <UserX/>
            </Button>
        </template>
    </BaseAlertDialog>
</template>
