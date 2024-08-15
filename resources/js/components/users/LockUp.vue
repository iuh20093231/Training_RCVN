<template>
    <b-modal id="confirm-lockup-modal" v-model="showModal" hide-header-close>
      <template #title>
        <h3 class="text-center"><strong>Nhắc nhở</strong></h3>
      </template>
      <div class="text-center">
        <i class="fa fa-lock text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn khóa/mở khóa người dùng <strong>{{ userName }}</strong> này không?</p>
      </div>
      <template #footer>
            <b-button variant="secondary" @click="resetModal">Hủy</b-button>
            <b-button variant="danger" @click="confirmLockUp">OKay</b-button>
      </template>
    </b-modal>
</template>
<script>
import { BModal } from 'bootstrap-vue-3';
import axios from 'axios';
export default {
    components: {
        BModal
     },
    data() {
        return {
        userName: '',
        showModal: false, 
        userId: null
        };
    },
    methods: {
        show(userName, userId) {
        this.userName = userName;
        this.userId = userId;
        this.showModal = true;
        },
        resetModal() {
        this.userName = '';
        this.userId = null;
        this.showModal = false;
        },
        confirmLockUp() {
            axios.post(`/users/${this.userId}/updatestatus`).then(response => {
               this.showModal = false;
               location.reload();
            });
            
        }
  }
};
</script>