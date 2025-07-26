<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import BaseForm from "@/components/crud/BaseForm.vue";
import UserForm from "@/components/crud/users/UserForm.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    }
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Usuários',
        href: route('users.index'),
    },
    {
        title: 'Editar Usuário',
        href: route('users.edit', props.user.id),
    },
];
</script>

<template>
    <Head title="Editar Usuário"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <BaseForm :index-route="route('users.index')">
            <template #content>
                <UserForm :user="props.user" />
            </template>
        </BaseForm>
    </AppLayout>
</template>
