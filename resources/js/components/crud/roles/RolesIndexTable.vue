<script setup>
import {Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import EditButton from "@/components/crud/EditButton.vue";
import DeleteButton from "@/components/crud/DeleteButton.vue";

defineProps({
    roleList: {
        type: Array,
        required: true,
    }
})

</script>

<template>
    <Table class="mb-4">
        <TableCaption>Perfis de usuário cadastrados no sistema.</TableCaption>
        <TableHeader>
            <TableRow>
                <TableHead>Descrição</TableHead>
                <TableHead class="text-center">Ações</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="role in roleList" :key="role.id">
                <TableCell class="font-medium">
                    {{ role.description }}
                </TableCell>
                <TableCell class="text-center space-x-2">
                    <EditButton :route="route('roles.edit', role.id)"/>
                    <DeleteButton record-label="Perfil" route-prefix="roles" :record="role"/>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
