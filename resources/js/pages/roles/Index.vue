<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import Index from "@/components/crud/Index.vue";
import LaravelPaginator from "@/components/crud/LaravelPaginator.vue";
import RolesIndexTable from "@/components/crud/roles/RolesIndexTable.vue";


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Peris',
        href: route('roles.index'),
    },
];

defineProps({
    paginator: {
        type: Object,
        required: true,
    }
})

</script>

<template>
    <Head title="Usuários"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <Index :createRoute="route('roles.create')">
            <template #content>
                <RolesIndexTable :role-list="paginator.data"/>

                <LaravelPaginator :paginator="paginator"/>
            </template>
        </Index>
    </AppLayout>
</template>
