<script setup>
import {useForm} from '@inertiajs/vue3';

const props = defineProps({
    url: {
        type: String,
        required: true
    }
});

const search = useForm({
    name: null
});
</script>

<template>
    <div class="flex items-right justify-center">
        <div class="bg-white shadow-md rounded flex items-center justify-center">
            <form class="flex" @submit.prevent="search.get(url + search.name)">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    v-model="search.name"
                    id="search"
                    type="text"
                    placeholder="Enter your search query..."
                />
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Search
                </button>
            </form>
        </div>
    </div>
</template>
