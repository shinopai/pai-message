<template>
<div>
  <a href="/"><i class="fas fa-arrow-left text-2xl cursor-pointer" title="チャットをやめる"></i></a>
<form class="fixed bottom-2 w-[80%] z-10">
    <label for="chat" class="sr-only">メッセージを入力してください</label>
    <div
      class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700"
    >
      <button
        type="button"
        class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
      >
        <svg
          class="w-6 h-6"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <button
        type="button"
        class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
      >
        <svg
          class="w-6 h-6"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <textarea
        id="chat"
        rows="1"
        class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="メッセージを入力してください" v-model="newMessage"
      ></textarea>
      <button
        type="button"
        class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600" @click="sendMessage(userId)"
      >
        <svg
          class="w-6 h-6 rotate-90"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
          ></path>
        </svg>
      </button>
    </div>
  </form>
  <div class="relative w-full p-6 overflow-y-scroll">
              <ul v-if="messages" class="space-y-2" id="message__outer">
                <li v-for="message in messages" :key="message" class="flex" :class="[message.user_id === userId ? 'justify-end' : 'justify-start']">
                  <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow" :class="[message.user_id == userId ? 'bg-gray-100' : '']">
                    <span class="block">{{ message.body }}</span>
              <span class="block font-bold" :class="[message.user_id == userId ? 'text-right' : 'text-left']">{{ message.user.name }}</span>
                  <span class="block" :class="[message.user_id == userId ? 'text-right' : 'text-left']">{{ dayjs(message.created_at ).format('H:mm')}}</span>
                  </div>
                </li>
              </ul>
              <p v-else class="text-center">メッセージはありません</p>
            </div>
            </div>
</template>

<script>
import { ref, onMounted, inject } from "vue";
import Axios from 'axios';

Axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

export default {
  setup() {
    let messages = ref()
    let newMessage = ref()
    const dayjs = inject('dayjs')

    console.log(userId);

    // get all messages
    const getMessages = async () => {
      await Axios.get('/api/rooms/' + roomId + '/get_messages')
                  .then( res => {
                    messages.value = res.data
                    console.log(messages.value);
                 })
                 .catch( err => {
                   console.log(err.response.data.message)
                 })
    }

    // send new message
    const sendMessage = async () => {
      await Axios.post('/api/rooms/' + roomId + '/users/' + userId + '/send_message', {
        body: newMessage.value
      })
                 .then( res => {
                  newMessage.value = ''
                   getMessages()
                 })
                 .catch( err => {
                   console.log(err.response.data.message)
                 })
    }

    onMounted(() => {
      getMessages();
    })

    return {
      roomId,
      userId,
      partnerId,
      messages,
      newMessage,
      sendMessage,
      dayjs
    }
  },
}
window.addEventListener('DOMContentLoaded', ()=>{
  let target = document.getElementById('message__outer');
  target.scrollIntoView(false);
});
</script>
