import { createApp } from 'vue'
import Message from './components/Message.vue'
import dayjs from 'dayjs'
import 'dayjs/locale/ja'

dayjs.locale('ja')

const app = createApp(Message)
app.provide('dayjs', dayjs)
app.mount('#vue-app')
