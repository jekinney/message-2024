<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    followers: Object,
});
</script>

<template>
    <Head title="Followers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">People who are following you.</h2>
            <p>List of other people who have decided to follow you and will see your messages in their message list.</p>
        </template>

        <div v-if="followers.data" v-for="follow in followers.data" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900">
                    {{ follow.name }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
