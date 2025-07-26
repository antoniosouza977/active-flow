<script setup>
import {Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import {UserPen, UserX} from "lucide-vue-next";
import {Button} from "@/components/ui/button";
import {Link} from "@inertiajs/vue3";
import InactivateUserButton from "@/components/crud/users/InactivateUserButton.vue";
import ActivateUserButton from "@/components/crud/users/ActivateUserButton.vue";
import EditButton from "@/components/crud/EditButton.vue";

defineProps({
    userList: {
        type: Array,
        required: true,
    }
})

</script>

<template>
    <Table class="mb-4">
        <TableCaption>Usuários cadastrados no sistema.</TableCaption>
        <TableHeader>
            <TableRow>
                <TableHead>Nome</TableHead>
                <TableHead>E-mail</TableHead>
                <TableHead>Organizações</TableHead>
                <TableHead class="text-center">Ações</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="user in userList" :key="user.id">
                <TableCell class="font-medium">
                    {{ user.name }}
                </TableCell>
                <TableCell>{{ user.email }}</TableCell>
                <TableCell>Orgs</TableCell>
                <TableCell class="text-center space-x-2">

                    <EditButton :route="route('users.edit', user.id)">
                        <template #icon>
                            <UserPen/>
                        </template>
                    </EditButton>

                    <InactivateUserButton v-if="user.is_active" :user="user"/>
                    <ActivateUserButton v-else :user="user"/>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
