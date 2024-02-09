<script setup>
const props = defineProps({
    followers: Object,
});
</script>

<template>
    <div v-if="followers.data" class="max-w-4xl mx-auto">
        <section v-for="follow in followers.data" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="pt-3 pb-3 pl-6 pr-6 text-gray-900">
                    <header class="flex justify-between pb-2">
                        <a href="" class="" >{{ follow.name }}</a>
                        <a href="" class="">Profile</a>
                    </header>
                    <footer class="border-t">
                        <ul class="flex justify-between pt-2">
                            <li>Messages: {{  follow.messages_count }}</li>
                            <li>Following: {{ follow.following_count }}</li>
                            <li>Followers: {{  follow.followers_count }}</li>
                        </ul>
                    </footer>
                </div>
            </div>
        </section>
    </div>
</template>
