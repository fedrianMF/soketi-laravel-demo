<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ChatMessages from '@/Components/Chat/ChatMessages.vue';
import ChatForm from '@/Components/Chat/ChatForm.vue';
import { computed, onMounted, ref } from "vue";
import { usePage } from '@inertiajs/vue3';

const messages = ref([]);
const users = ref([]);
const user = computed(() => usePage().props.value.auth.user);

const fetchMessages = () => {
  axios.get("/messages").then((response) => {
    messages.value = response.data;
  });
};

const addMessage = (message) => {
    messages.value.push(message);
    axios.post("/messages", message).then((response) => {
        console.log(response.data);
    });
};

onMounted(() => {
    fetchMessages();

    /*Echo.join("chat").here((receivedUsers) => {
        users.value = receivedUsers;
    }).joining((user) => {
        users.value.push(user);
    }).leaving((user) => {
        users.value = users.value.filter((u) => u.id !== user.id);
    }).listenForWhisper("typing", ({ id, name }) => {
        users.value = users.value.map((user) => {
            if (user.id === id) {
                return { ...user, typing: true };
            }
            return user;
        });
    }).listen("MessageSent", (event) => {
        messages.value.push({
            message: event.message.message,
            user: event.user,
        });

        users.value = users.value.map((user) => {
            if (user.id === event.user.id) {
                return { ...user, typing: false };
            }
            return user;
        });
    });*/
});

/*Echo.channel("notification").listen("MessageNotification", (e) => {
    alert(e.message);
    console.log(e.message);
});*/
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="container mx-auto px-4">
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full md:w-2/3 px-4 md:mx-auto">
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                        <div
                                            class="bg-gray-100 px-6 py-4 border-b border-gray-200 font-semibold text-gray-700">
                                            Chats
                                        </div>

                                        <div class="p-6">
                                            <ChatMessages :messages="messages" />
                                        </div>
                                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                                            <ChatForm @messagesent="addMessage" :user="$page.props.auth.user" />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/3 px-4 mt-6 md:mt-0">
                                    <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
                                        <li class="px-6 py-4" v-for="user in users">
                                            @{{ user.name }}
                                            <span v-if="user.typing"
                                                class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">typing...</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
