<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Pagination from '../../Components/Pagination.vue';

const props = defineProps({
    following: Object,
});

const form = useForm({
    id: null
});
</script>

<template>
    <Head title="Following" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Other people you are following</h2>
            <p>List of people you have chosen to follow. Their messages will be on your message list.</p>
        </template>

        <div v-if="following.data" v-for="follow in following.data" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{  follow.name }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Followed on {{  follow.pivot.created_at }}</p>
                </div>

                <form @submit.prevent="form.delete('/following/'+ follow.id)" >
                    <input type="hidden" v-model="form.id" />
                    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm
                                font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none
                                focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                            Remove
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <Pagination :collection="following" />
    </AuthenticatedLayout>
</template>
