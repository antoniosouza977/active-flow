<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import RoleForm from "@/components/crud/roles/RoleForm.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Perfis',
        href: route('roles.index'),
    },
    {
        title: 'Criar Perfil',
        href: route('roles.create'),
    },
];

</script>

<template>
    <Head title="Criar Perfil"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <RoleForm/>
    </AppLayout>
</template>
