import './bootstrap';

import { createApp, ref } from 'vue';
import ChatBox from './components/ChatBox.vue';

const app = createApp(ChatBox);
app.mount('#app');
