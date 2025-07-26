<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import type {BreadcrumbItem} from "@/types";
import Index from "@/components/crud/Index.vue";
import LaravelPaginator from "@/components/crud/LaravelPaginator.vue";
import UsersIndexTable from "@/components/crud/users/UsersIndexTable.vue";


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Usuários',
        href: route('users.index'),
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
        <Index :createRoute="route('users.create')">
            <template #content>
                <UsersIndexTable :user-list="paginator.data"/>

                <LaravelPaginator :paginator="paginator"/>
            </template>
        </Index>
    </AppLayout>
</template>
