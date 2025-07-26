<script setup lang="ts">

import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form";
import {Input} from "@/components/ui/input";
import {Button} from "@/components/ui/button";
import {toTypedSchema} from "@vee-validate/zod";
import {z} from "@/lib/zod";
import {useForm} from "vee-validate";
import {router} from "@inertiajs/vue3";
import {toast} from 'vue-sonner'
import {computed} from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: false,
    }
})

const isEditing = computed(() => !!props.user?.id);

const formSchema = computed(() => toTypedSchema(
    z.object({
        id: z.number().optional(),
        name: z.string().min(2),
        email: z.string().email(),
        password: z.string().min(8).or(z.literal('')).optional(),
        password_confirmation: z.string().or(z.literal('')).optional(),
    })
        .superRefine((data, ctx) => {
            if (!isEditing.value && !data.password) {
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

const {handleSubmit, setErrors} = useForm({
    validationSchema: formSchema,
    initialValues: {
        id: props.user?.id,
        name: props.user?.name,
        email: props.user?.email,
    }
})

const onSubmit = handleSubmit((values) => {
    const options = {
        onError: (err: Object) => setErrors(err),
        onSuccess: () => toast(`Usuário ${isEditing.value ? 'atualizado' : 'criado'} com sucesso!`),
        preserveScroll: true,
    };

    if (isEditing.value) {
        return router.patch(route('users.update', props.user.id), values, options);
    }

    return router.post(route('users.store'), values, options);
})

</script>

<template>
    <form class="w-2/3 space-y-6" @submit="onSubmit">
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

        <Button type="submit">
            Salvar
        </Button>
    </form>
</template>
