<template>
    <div class="flex justify-center">
        <div class="flex flex-col mx-auto justify-center mt-8">
            <Input class="mx-auto min-w-[33%]" v-model="fulltext" placeholder="Zadejte název díla" label="Název díla">
                <template #prefix>
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </template>
            </Input>

            <div class="m-8 grid gap-4 grid-cols-4">
                <div v-for="medium in media" :key="medium.id">
                    <router-link :to="`detail/${ medium.id }`" href="#" class="block mr-4 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <Badge :type="medium.type === 'Book' ? 'green' : (medium.type === 'Magazine' ? 'purple' : 'red')">{{ medium.type === 'Book' ? 'kniha' : (medium.type === 'Magazine' ? 'magazín' : 'elektronický nosič') }}</Badge>

                        <h5 class="mt-4 mb-2 max-h-16 text-ellipsis overflow-hidden text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ medium.title }}</h5>
                        <div class="font-normal text-gray-700 dark:text-gray-400 h-60 text-ellipsis overflow-hidden">{{ medium.description }}</div>
                    </router-link>
                </div>
            </div>

            <Pagination class="mx-auto" v-model="currentPage" :total-pages="totalPages"></Pagination>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import { Input, Pagination, Badge } from 'flowbite-vue';
import { watchDebounced } from '@vueuse/core'
import axios from 'axios';

const currentPage = ref(1);
const fulltext = ref('');
const media = ref();
const totalPages = ref(0);

const fetchData = async () => {
    const res = await axios.get(`/api/medium/?offset=${ currentPage.value }${ fulltext.value ? `&fulltext=${ fulltext.value }` : '' }`);
    media.value = res.data.data;
    totalPages.value = Math.floor(res.data.totalCount / 12);
}

watch(currentPage, () => {
    fetchData();
});

watchDebounced(
    fulltext,
    () => { fetchData() },
    { debounce: 500, maxWait: 1000 },
)

onMounted(async () => {
    await fetchData();
})
</script>
