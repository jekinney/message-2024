<script setup>
defineProps({
    show: {
        type: Boolean,
        default: false,
        required: false
    },
    message: {
        type: String,
        required: true
    }
});

</script>

<template>
    <div v-if="show" class="max-w-4xl mx-auto mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>{{  message }}</h2>
                </div>
            </div>
        </div>
    </div>
</template>
