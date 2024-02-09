<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    following: Object,
});

const form = useForm({
    id: null
});
</script>

<template>
    <div v-if="following.data" class="max-w-4xl mx-auto mt-6">
        <div v-for="follow in following.data" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ follow.name }}</h3>
                </div>

                <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                    <p class="text-sm text-gray-500">Followed on {{  follow.pivot.created_at }}</p>

                    <form @submit.prevent="form.delete('/following/'+ follow.id)" >
                        <input type="hidden" v-model="form.id" />
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm
                                font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none
                                focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                            Remove
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>
