<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import RoleForm from "@/components/crud/roles/RoleForm.vue";

const props = defineProps({
    role: {
        type: Object,
        required: true,
    }
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Perfis',
        href: route('roles.index'),
    },
    {
        title: 'Editar Perfil',
        href: route('roles.edit', props.role.id),
    },
];
</script>

<template>
    <Head title="Editar Perfil"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <RoleForm :role="props.role"/>
    </AppLayout>
</template>
