<script setup>
import { useForm } from '@inertiajs/vue3';
import NoDataMessage from '../../../Components/NoDataMessage.vue';

const props = defineProps({
    users: Object,
    following: Array
});

const form = useForm({
    id: null
});

</script>


<template>
    <div class="max-w-4xl mx-auto">
        <div v-if="users.data" v-for="user in users.data"  class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">

                <header class="flex justify-between p-3">
                    <a href="" class="" >{{ user.name }}</a> signed up {{  user.created_at }}
                    <a href="" class="">Profile</a>
                </header>

                <footer class="border-t flex justify-end p-3">
                    <form v-if="following !== null && following.includes(user.id)" @submit.prevent="form.delete('/following/'+ user.id)">
                        <input type="hidden" v-model="form.id" />
                        <button
                            type="submit"
                            class="inline-flex items-center px-2 py-1 border border-transparent shadow-sm text-sm
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
                            class="inline-flex items-center px-2 py-1 border border-transparent shadow-sm text-sm
                                font-medium rounded-md bg-green-600 hover:bg-green-700 focus:outline-none
                                focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                            Follow
                        </button>
                    </form>

                </footer>

            </div>
        </div>
    </div>
</template>
