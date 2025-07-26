<script setup>

import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form";
import {Input} from "@/components/ui/input";
import {toTypedSchema} from "@vee-validate/zod";
import {z} from "@/lib/zod";
import {computed} from "vue";
import BaseForm from "@/components/crud/BaseForm.vue";

const props = defineProps({
    role: {
        type: Object,
        required: false,
    }
})

const formSchema = computed(() => toTypedSchema(
    z.object({
        id: z.number().optional(),
        description: z.string().min(3),
    }))
);


const initialValues = {
    id: props.role?.id,
    description: props.role?.description,
}
</script>

<template>
    <BaseForm :form-schema="formSchema" :initial-values="initialValues"
              resource-label="Perfil" route-prefix="roles">
        <template #content>
            <div>
                <FormField v-slot="{ componentField }" name="description">
                    <FormItem>
                        <FormLabel>Descrição</FormLabel>
                        <FormControl>
                            <Input type="text" v-bind="componentField"/>
                        </FormControl>
                        <FormMessage/>
                    </FormItem>
                </FormField>
            </div>
        </template>
    </BaseForm>


</template>
