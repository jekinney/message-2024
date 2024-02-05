<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';
import UserListCards from './Partials/UserListCard.vue';

const props = defineProps({
    users: Object,
    following: Array
});

const search = useForm({
    name: null
})

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <div class="flex items-right justify-center">
                    <div class="bg-white shadow-md rounded flex items-center justify-center">
                        <form class="flex" @submit.prevent="search.get('/users?name='+ search.name)">
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
            </div>
        </template>

        <UserListCards :users="users" :following="following" />
        <Pagination :collection="users" />
    </AuthenticatedLayout>
</template>
