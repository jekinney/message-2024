<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    messages: Object,
});

</script>

<template>
    <Head title="Messages" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Messages</h2>
        </template>

        <div class="py-12">
            <div v-if="messages.data" v-for="message in messages.data"  class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <header class="p-2">
                        <a href="" class="">{{  message.author.name }}</a> posted on {{  message.created_at }}
                        <a href="" class="">Author's Messages</a>
                    </header>
                    <article class="p-3 pl-6 text-gray-900">
                        {{  message.body }}
                    </article>
                    <hr>
                    <footer class="p-2">
                        <a href="" class="">Like</a>
                        <a href="" class="">Dislike</a>
                        <a href="" class="">Author's Messages</a>
                        <a href="" class="">Un-follow</a>
                    </footer>
                </div>
            </div>

            <div v-else class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Not messages yet
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
