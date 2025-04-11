<script setup>
defineProps({
    messages: Array,
});
</script>
<template>
    <ul class="space-y-4">
        <li class="flex flex-col" v-for="message in messages" :key="message.id">
            <div class="flex flex-col space-y-2">
                <div class="font-semibold text-gray-800">
                    {{ message.user.name }}
                </div>
                <p class="text-gray-700 bg-gray-100 rounded-lg p-3 max-w-[80%]">
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>
