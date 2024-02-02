<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MessageList from './Partials/MessagesList.vue';
import { Head } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';

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

        <MessageList :messages="messages"/>

        <Pagination :messages="messages" />
    </AuthenticatedLayout>
</template>
