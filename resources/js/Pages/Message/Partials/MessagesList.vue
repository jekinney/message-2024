<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    messages: Object,
});

function hasMessages(messages) {
    return Object.keys(messages.data).length !== 0;
}

function addLike(id) {
    router.post(`/api/message/like/${id}`)

    router.reload()
}

function addUnlike(id) {
    console.log(id)
    // this.$inertia.post(`/message/unlike/${id}`)
    // .then(response => {
    //     this.messages = response.data.data
    // }).catch(errors => {
    //     console.log(errors)
    // })
}

function submitReport(id) {
    console.log(id)
    // this.$inertia.post(`/message/report/${id}`)
    // .then(response => {
    //     this.messages = response.data.data
    // }).catch(errors => {
    //     console.log(errors)
    // })
}
</script>

<template>
    <div class="max-w-4xl mx-auto">
        <!-- Message Container -->
        <div v-if="hasMessages(messages)" v-for="message in messages.data" class="bg-white shadow-md rounded-md p-6 mt-4">

            <header class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <span class="font-semibold text-lg">{{ message.author.name }}</span>
                    <span class="text-gray-500 text-sm ml-2">posted at {{ message.created_at }}</span>
                </div>
            </header>

            <article class="mb-4">
                <p class="text-gray-700">
                    {{ message.body }}
                </p>
            </article>

            <footer class="flex justify-between items-center">
                <div class="flex items-center">
                    <button @click="addLike(message.id)" class="text-blue-500 hover:text-blue-700 focus:outline-none mr-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9.293 1.293a1 1 0 0 1 1.414 0l7 7a1 1 0 0 1 0 1.414l-7 7a1 1 0 0 1-1.414-1.414L15.586 10 9.293 3.707a1 1 0 0 1 0-1.414z"
                            />
                            <path
                                fill-rule="evenodd"
                                d="M3 10a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7 10a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-4 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"
                            />
                        </svg>
                        <span>{{  message.likeable_count }}</span>
                    </button>
                    <button @click="addUnlike(message.id)" class="text-red-500 hover:text-red-700 focus:outline-none mr-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a8 8 0 0 0-8 8c0 4.418 3.582 8 8 8s8-3.582 8-8a8 8 0 0 0-8-8zm0 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm1-9h-2v5h2V7z"
                            />
                        </svg>
                        <span>{{  message.unlikeable_count }}</span>
                    </button>
                </div>
                <button @click="submitReport(message)" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    Report
                </button>
            </footer>

        </div>
    </div>
</template>
