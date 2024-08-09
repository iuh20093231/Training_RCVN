import { createApp } from 'vue';
import TaskManager from './components/TaskManager.vue';
import TaskUser from './components/users/TaskUser.vue';
import TaskCustomer from './components/customer/TaskCustomer.vue';
import TaskProduct from './components/product/TaskProduct.vue';
import AddProduct from './components/product/AddProduct.vue';
import TaskLogin from './components/login/TaskLogin.vue';
import BootstrapVue3 from 'bootstrap-vue-3';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
const app = createApp({
    components: {
        TaskManager,
        TaskUser,
        TaskCustomer,
        TaskProduct,
        AddProduct,
        TaskLogin
    }
});
app.use(BootstrapVue3);
app.mount('#app');