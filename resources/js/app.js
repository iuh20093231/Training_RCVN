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
import { BModal, BButton } from 'bootstrap-vue-3';
app.component('b-modal', BModal);
app.component('b-button', BButton);
app.use(BootstrapVue3);
app.mount('#app');