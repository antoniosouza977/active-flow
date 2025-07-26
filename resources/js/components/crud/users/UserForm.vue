<script setup lang="ts">

import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form";
import {Input} from "@/components/ui/input";
import {toTypedSchema} from "@vee-validate/zod";
import {z} from "@/lib/zod";
import {computed} from "vue";
import BaseForm from "@/components/crud/BaseForm.vue";

const props = defineProps({
    user: {
        type: Object,
        required: false,
    }
})

const formSchema = computed(() => toTypedSchema(
    z.object({
        id: z.number().optional(),
        name: z.string().min(2),
        email: z.string().email(),
        password: z.string().min(8).or(z.literal('')).optional(),
        password_confirmation: z.string().or(z.literal('')).optional(),
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
}

</script>

<template>
    <BaseForm :form-schema="formSchema" :initial-values="initialValues"
              resource-label="Usuário" route-prefix="users">
        <template #content>
            <div class="space-y-6">
                <FormField v-slot="{ componentField }" name="name">
                    <FormItem>
                        <FormLabel>Nome</FormLabel>
                        <FormControl>
                            <Input type="text" v-bind="componentField"/>
                        </FormControl>
                        <FormMessage/>
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="email">
                    <FormItem>
                        <FormLabel>E-mail</FormLabel>
                        <FormControl>
                            <Input type="text" v-bind="componentField"/>
                        </FormControl>
                        <FormMessage/>
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="password">
                    <FormItem>
                        <FormLabel>Senha</FormLabel>
                        <FormControl>
                            <Input type="password" v-bind="componentField"/>
                        </FormControl>
                        <FormMessage/>
                    </FormItem>
                </FormField>

                <FormField v-slot="{ componentField }" name="password_confirmation">
                    <FormItem>
                        <FormLabel>Senha de confirmação</FormLabel>
                        <FormControl>
                            <Input type="password" v-bind="componentField"/>
                        </FormControl>
                        <FormMessage/>
                    </FormItem>
                </FormField>
            </div>
        </template>
    </BaseForm>
</template>
