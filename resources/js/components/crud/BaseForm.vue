<script setup>
import {Button} from '@/components/ui/button'
import {Link, router} from '@inertiajs/vue3'
import {toast} from "vue-sonner";
import {useForm} from "vee-validate";
import {computed} from "vue";

const props = defineProps({
    formSchema: {
        required: true
    },
    initialValues: {
        type: Object,
        required: true
    },
    resourceLabel: {
        type: String,
        required: true
    },
    routePrefix: {
        type: String,
        required: true
    }
})

const id = computed(() => props.initialValues?.id)

const {handleSubmit, setErrors} = useForm({
    validationSchema: props.formSchema,
    initialValues: props.initialValues
})

const submitForm = handleSubmit((values) => {
    const options = {
        onError: (err) => setErrors(err),
        onSuccess: () => toast(`${props.resourceLabel} ${id.value ? 'atualizado' : 'criado'} com sucesso!`),
        preserveScroll: true,
    };

    if (id.value) {
        return router.patch(route(`${props.routePrefix}.update`, id.value), values, options);
    }

    return router.post(route(`${props.routePrefix}.store`), values, options);
})

</script>

<template>
    <div class="h-full p-4 ">
        <div class="h-full rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
            <div class="flex justify-end p-4">
                <Link :href="route(`${routePrefix}.index`)">
                    <Button>Voltar</Button>
                </Link>
            </div>
            <div class="p-4">
                <form @submit="submitForm" class="lg:w-2/3 w-full space-y-6">
                    <slot name="content" />
                    <Button type="submit">Salvar</Button>
                </form>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
