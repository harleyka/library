<template>
    <div class="flex justify-center mx-auto">
        <div class="flex flex-col mx-auto justify-center mt-8 w-1/2">
            <Button @click="$router.push('/')" outline>Zpět</Button>

            <div v-if="detailData" class="mt-8">
                <h5 class="mb-2 text-2xl text-center font-bold  tracking-tight text-gray-900 dark:text-white">{{ detailData.title }}</h5>

                <tabs v-model="activeTab" class="p-5">
                    <tab name="first" title="Popis">
                        <Badge :type="detailData.type === 'Book' ? 'green' : (detailData.type === 'Magazine' ? 'purple' : 'red')">{{ detailData.type === 'Book' ? 'kniha' : (detailData.type === 'Magazine' ? 'magazín' : 'elektronický nosič') }}</Badge>

                        <p class="mt-4 font-normal text-gray-700 dark:text-gray-400">
                            {{ detailData.description }}
                        </p>
                    </tab>
                    <tab v-if="detailData.author" name="second" title="Autor">
                        <p class="border-b border-gray pb-4 mb-4">Jméno: {{ detailData.author.full_name }}</p>
                        <p>E-mail: {{ detailData.author.email }}</p>
                    </tab>
                </tabs>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Button, Tabs, Tab, Badge } from 'flowbite-vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const activeTab = ref('first');
const route = useRoute();

const detailData = ref();

onMounted(async () => {
    const res = await axios.get(`/api/medium/${ route.params.id }`);
    detailData.value = res.data.data;
})
</script>
