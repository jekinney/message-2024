<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
    following: Array
});

const form = useForm({
    id: null
});

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div v-if="users.data" v-for="user in users.data"  class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <header class="p-2">
                        <a href="" class="">{{  user.name }}</a> signed up {{  user.created_at }}
                    </header>
                    <hr>
                    <footer class="p-2">
                        <a href="" class="">Profile</a>
                        <form v-if="following !== null && following.includes(user.id)" @submit.prevent="form.delete('/following/'+ user.id)" >
                            <input type="hidden" v-model="form.id" />
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm
                                font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none
                                focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Un-follow
                            </button>
                        </form>
                        <form v-else @submit.prevent="form.post('/following/'+ user.id)" >
                            <input type="hidden" v-model="form.id" />
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm
                                    font-medium rounded-md bg-green-600 hover:bg-green-700 focus:outline-none
                                    focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Follow
                            </button>
                        </form>
                    </footer>
                </div>
            </div>

            <div v-else class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Not users yet
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
