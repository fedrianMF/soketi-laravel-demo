<script setup>
import { ref } from "vue";
const emit = defineEmits(["messagesent"]);
const newMessage = ref("");

defineProps({
  user: Object,
});

const sendTypingEvent = (user) => {
  Echo.join("chat").whisper("typing", user);
};
const sendMessage = (user) => {
  emit("messagesent", { message: newMessage.value, user: user });
  newMessage.value = "";
};
</script>
<template>
  <div class="flex rounded-md shadow-sm">
    <input
      id="btn-input"
      type="text"
      name="message"
      class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
      placeholder="Type your message here..."
      v-model="newMessage"
      @keyup.enter="sendMessage(user)"
      @keyup="sendTypingEvent(user)"
    />

    <button
      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
      id="btn-chat"
      @click="sendMessage(user)"
    >
      Send
    </button>
  </div>
</template>
