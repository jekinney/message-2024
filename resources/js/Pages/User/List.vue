<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';
import UserListCards from './Partials/ListCard.vue';
import NoDataMessage from '../../Components/NoDataMessage.vue';
import HeaderSearchForm from '../../Components/HeaderSearchForm.vue';

const props = defineProps({
    users: Object,
    following: Array
});
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <HeaderSearchForm :url="'/users?search='" />
            </div>
        </template>

        <UserListCards :users="users" :following="following" />

        <NoDataMessage :show="users.data.length === 0" :message="'No Users to display.'" />

        <Pagination :collection="users" />

    </AuthenticatedLayout>
</template>
