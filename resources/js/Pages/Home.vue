<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />

    <GuestLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a href="/login">Login</a> or <a href="/register">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
