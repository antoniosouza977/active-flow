<script setup lang="ts">
import {
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
    PaginationRoot
} from 'reka-ui'

import {router} from "@inertiajs/vue3";
import {Icon} from '@iconify/vue'

const props = defineProps({
    paginator: {
        type: Object,
        required: true,
    }
})

const updatePage = function (pageNumber: Number) {
    router.get(props.paginator.path, {
        page: pageNumber.toString()
    })
}

</script>

<template>
    <PaginationRoot
        class="flex justify-center"
        @update:page="updatePage"
        :total="paginator.total"
        :sibling-count="1"
        :items-per-page="paginator.per_page"
        show-edges
        :default-page="paginator.current_page"
    >
        <PaginationList
            v-slot="{ items }"
            class="flex items-center gap-1 text-stone-700 dark:text-white"
        >
            <PaginationFirst
                class="w-9 h-9 cursor-pointer flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition disabled:opacity-50 rounded-lg">
                <Icon icon="radix-icons:double-arrow-left"/>
            </PaginationFirst>
            <PaginationPrev
                class="w-9 h-9 cursor-pointer flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition mr-4  disabled:opacity-50 rounded-lg">
                <Icon icon="radix-icons:chevron-left"/>
            </PaginationPrev>
            <template v-for="(page, index) in items">
                <PaginationListItem
                    v-if="page.type === 'page'"
                    :key="index"
                    class="w-9 h-9 rounded-lg data-[selected]:border dark:hover:bg-stone-700/70 transition cursor-pointer"
                    :value="page.value"
                >
                    {{ page.value }}
                </PaginationListItem>
                <PaginationEllipsis
                    v-else
                    :key="page.type"
                    :index="index"
                    class="w-9 h-9 flex items-center justify-center"
                >
                    &#8230;
                </PaginationEllipsis>
            </template>
            <PaginationNext
                class="w-9 h-9 cursor-pointer flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition ml-4 disabled:opacity-50 rounded-lg">
                <Icon icon="radix-icons:chevron-right"/>
            </PaginationNext>
            <PaginationLast
                class="w-9 h-9 cursor-pointer flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition disabled:opacity-50 rounded-lg">
                <Icon icon="radix-icons:double-arrow-right"/>
            </PaginationLast>
        </PaginationList>
    </PaginationRoot>
</template>
