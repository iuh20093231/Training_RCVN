<template>
    <b-modal id="confirm-lockup-modal" title="Nhắc nhở" @ok="confirmLockUp" @hide="resetModal" ok-title="Okay" cancel-title="Hủy" @hidden="resetModal" v-model="showModal">
      <template #modal-title>
        <h3 class='text-danger'>Nhắc nhở</h3>
      </template>
      <div class="text-center">
        <i class="fa fa-lock text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn khóa/mở khóa người dùng <strong>{{ userName }}</strong> này không?</p>
      </div>
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
        },
        confirmLockUp() {
            axios.post(`/users/${this.userId}/updatestatus`);
            this.$emit('lockup-confirmed');
            
        }
  }
};
</script>