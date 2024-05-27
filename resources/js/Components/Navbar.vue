<template>
    <nav class="bg-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Links -->
                <div>
                    <div class="flex items-baseline space-x-4 justify-end">
                        <!-- Dashboard link -->
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Dashboard
                        </Link>
                        <!-- Register link -->
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Register
                        </Link>
                        <!-- Login link -->
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="text-white hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Login
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<style scoped>
nav {
    width: 100%;
}

nav a {
    color: white;
}

nav a:hover,
nav a:focus {
    background-color: rgba(0, 0, 0, 0.2);
}
</style>
