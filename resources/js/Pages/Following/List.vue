<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';
import ListCard from './Partials/ListCard.vue';
import NoDataMessage from '../../Components/NoDataMessage.vue';

const props = defineProps({
    following: Object,
});
</script>

<template>
    <Head title="Following" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Other people you are following</h2>
            <p>List of people you have chosen to follow. Their messages will be on your message list.</p>
        </template>

        <ListCard :following="following" />

        <NoDataMessage :show="following.data.length === 0" :message="'You are not following any one.'" />

        <Pagination :collection="following" />

    </AuthenticatedLayout>
</template>
