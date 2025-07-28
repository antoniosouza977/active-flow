<script setup>

import {Tabs, TabsContent, TabsList, TabsTrigger} from '@/components/ui/tabs'
import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form";
import {Input} from "@/components/ui/input";
import {toTypedSchema} from "@vee-validate/zod";
import {z} from "@/lib/zod";
import {computed, ref} from "vue";
import BaseForm from "@/components/crud/BaseForm.vue";
import SearchField from "@/components/crud/SearchField.vue";
import {Checkbox} from '@/components/ui/checkbox'
import {FormDescription} from "@/components/ui/form/index.js";


const props = defineProps({
    user: {
        type: Object,
        required: false,
    }
})

const roles = ref(props.user?.roles || [])

const formSchema = computed(() => toTypedSchema(
    z.object({
        id: z.number().optional(),
        name: z.string().min(2),
        email: z.string().email(),
        password: z.string().or(z.literal(null)).optional(),
        password_confirmation: z.string().or(z.literal(null)).optional(),
        roles: z.array(z.number()),
    })
        .superRefine((data, ctx) => {
            if (!props.user?.id && !data.password) {
                ctx.addIssue({
                    code: z.ZodIssueCode.custom,
                    message: 'A senha é obrigatória.',
                    path: ['password'],
                });
            }

            if (data.password && data.password !== data.password_confirmation) {
                ctx.addIssue({
                    code: z.ZodIssueCode.custom,
                    message: 'As senhas não coincidem.',
                    path: ['password_confirmation'],
                });
            }
        })
));

const initialValues = {
    id: props.user?.id,
    name: props.user?.name,
    email: props.user?.email,
    roles: props.user?.roles?.map(role => role.id) || []
}

function beforeSubmit(data) {

    console.log(data)
    if (!data.password) {
        delete data.password;
    }

    return data;
}

function handleRoleSearch(data) {
    const newRoles = data.filter(newRole => {
        return !roles.value.some(existingRole => existingRole.id === newRole.id);
    });
    roles.value = [...roles.value, ...newRoles];
}

</script>

<template>

    <BaseForm :form-schema="formSchema" :initial-values="initialValues" :berofe-handle="beforeSubmit"
              resource-label="Usuário" route-prefix="users">
        <template #content>
            <Tabs class="space-y-6" default-value="general">
                <TabsList>
                    <TabsTrigger value="general">
                        Informações gerais
                    </TabsTrigger>
                    <TabsTrigger value="perfis">
                        Perfis
                    </TabsTrigger>
                </TabsList>
                <TabsContent value="general">
                    <div class="space-y-6">
                        <FormField v-slot="{ componentField }" name="name">
                            <FormItem>
                                <FormLabel>Nome</FormLabel>
                                <FormControl>
                                    <Input type="text" v-bind="componentField" autocomplete="name"/>
                                </FormControl>
                                <FormMessage/>
                            </FormItem>
                        </FormField>

                        <FormField v-slot="{ componentField }" name="email">
                            <FormItem>
                                <FormLabel>E-mail</FormLabel>
                                <FormControl>
                                    <Input type="text" v-bind="componentField" autocomplete="email"/>
                                </FormControl>
                                <FormMessage/>
                            </FormItem>
                        </FormField>

                        <FormField v-slot="{ componentField }" name="password">
                            <FormItem>
                                <FormLabel>Senha</FormLabel>
                                <FormControl>
                                    <Input type="password" v-bind="componentField" autocomplete="new-password"/>
                                </FormControl>
                                <FormMessage/>
                            </FormItem>
                        </FormField>

                        <FormField v-slot="{ componentField }" name="password_confirmation">
                            <FormItem>
                                <FormLabel>Senha de confirmação</FormLabel>
                                <FormControl>
                                    <Input type="password" v-bind="componentField" autocomplete="new-password"/>
                                </FormControl>
                                <FormMessage/>
                            </FormItem>
                        </FormField>
                    </div>
                </TabsContent>
                <TabsContent value="perfis">
                    <SearchField class="mb-4" placeholder="Digite o nome do perfil para pesquisar"
                                 @search:complete="handleRoleSearch" :route="route('roles.query')"/>

                    <FormField name="roles">
                        <FormItem>
                            <div v-if="roles.length" class="mb-4">
                                <FormDescription>
                                    Selecione os perfis do usuário.
                                </FormDescription>
                            </div>

                            <FormField v-for="item in roles" v-slot="{ value, handleChange }" :key="item.id" type="checkbox" :value="item.id" :unchecked-value="false" name="roles">
                                <FormItem class="flex flex-row items-start space-x-3 space-y-0">
                                    <FormControl>
                                        <Checkbox
                                            :model-value="value.includes(item.id)"
                                            @update:model-value="handleChange"
                                        />
                                    </FormControl>
                                    <FormLabel class="font-normal">
                                        {{ item.description }}
                                    </FormLabel>
                                </FormItem>
                            </FormField>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                </TabsContent>
            </Tabs>


        </template>
    </BaseForm>
</template>
