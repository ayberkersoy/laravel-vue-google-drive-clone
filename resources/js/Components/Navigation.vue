<script setup>

import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import CreateNewDropdown from "@/Components/CreateNewDropdown.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <nav class="min-w-[200px]">
        <div class="h-[80px] px-3 flex items-center gap-3">
            <Link :href="route('my-files')" class="h-[80px] px-3 flex items-center gap-3">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-800"
                />
                LaraStorage
            </Link>
        </div>
        <div class="px-3">
            <CreateNewDropdown />

            <div class="py-3">
                <NavLink :href="route('my-files')" :active="$page.url === '/my-files'">My Files</NavLink>
                <NavLink href="/">Shared with me</NavLink>
                <NavLink href="/">Shared by me</NavLink>
                <NavLink href="/">Trash</NavLink>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
