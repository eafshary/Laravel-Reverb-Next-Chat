<script setup lang="ts">
useSeoMeta({
    title: 'Dashboard',
})

definePageMeta({
    middleware: ['$auth'],
});

const { data: users } = await useAsyncData(
    'users', () => useSanctumFetch('/api/users')
)
</script>

<template>
    <div>
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold ">Users</h1>
            </div>
        </header>

        <div class="flex flex-col items-center py-5">
            <div class="container w-full h-full p-8 space-y-3 bg-white rounded-xl">

                <div v-if="users && users.length > 0">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="user in users" :key="user.id"
                            class="overflow-hidden bg-white border shadow-md sm:rounded-lg">
                            <NuxtLink :to="`/chats/${user.id}`">
                                <div class="p-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full">
                                            <span class="text-lg font-bold text-gray-500">
                                                {{ user.name.slice(0, 1).toUpperCase() }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ user.name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>