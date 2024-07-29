import { createApp } from 'vue';
import TaskManager from './components/TaskManager.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
createApp({
    components: {
        TaskManager
    }
}).mount('#app');