<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import UserForm from "@/components/crud/users/UserForm.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Usuários',
        href: route('users.index'),
    },
    {
        title: 'Criar Usuário',
        href: route('users.create'),
    },
];

</script>

<template>
    <Head title="Criar Usuário"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <UserForm/>
    </AppLayout>
</template>

<style scoped>

</style>
