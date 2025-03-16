<script setup lang="ts">
const { isLoggedIn, user, logout } = useSanctum<User>();
const logoutUser = () => logout();
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="p-4 text-white bg-gray-800">
            <div class="container flex items-center justify-between mx-auto">
                <div>
                    <NuxtLink to="/" class="text-xl font-bold">Home</NuxtLink>
                </div>
                <div>
                    <template v-if="!isLoggedIn">
                        <NuxtLink to="/auth/login" class="mr-4">Login</NuxtLink>
                        <NuxtLink to="/auth/register" class="mr-4">Register</NuxtLink>
                    </template>
                    <template v-if="isLoggedIn">
                        <NuxtLink to="/dashboard" class="mr-4">Dashboard</NuxtLink>
                        <button @click="logoutUser" class="mr-4">Logout</button>
                        <span v-if="user">Welcome, {{ user.name }}</span>
                    </template>
                </div>
            </div>
        </nav>

        <slot />
    </div>
</template>