<template>
    <b-modal id="confirm-lockup-modal" v-model="showModal" hide-header-close centered size="md" no-close-on-esc no-close-on-backdrop>
      <template #title>
        <h4 class="text-center text-danger fw-bold">NHẮC NHỞ</h4>
      </template>
      <div class="text-center">
        <i class="fa fa-lock text-warning" style="font-size: 60px;"></i>
        <p class="mt-3 text-dark fw-bold">Bạn có chắc muốn khóa/mở khóa người dùng <strong class="text-danger">{{ userName }}</strong>?</p>
      </div>
      <template #footer>
        <div class="d-flex justify-content-center">
          <b-button variant="outline-secondary" class="px-3 py-2" @click="resetModal">Hủy</b-button>
          <b-button variant="danger" class="px-3 py-2 ms-2" @click="confirmLockUp">
            <i class="fas fa-check me-2"></i> OKay
          </b-button>
        </div>
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