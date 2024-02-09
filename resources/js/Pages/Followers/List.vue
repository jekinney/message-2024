<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import NoDataMessage from '../../Components/NoDataMessage.vue';
import ListCard from './Partials/ListCard.vue';
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

        <ListCard :followers="followers" />

        <Pagination :collection="followers" />

        <NoDataMessage :show="followers.data.length === 0" :message="'Sorry, no followers at this time.'" />

    </AuthenticatedLayout>
</template>
