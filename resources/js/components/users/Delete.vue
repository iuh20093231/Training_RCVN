<template>
    <b-modal id="confirm-delete-modal" title="Nhắc nhở" @ok="confirmDelete" @hide="resetModal" ok-title="Okay" cancel-title="Hủy" @hidden="resetModal" v-model="showModal">
      <template #modal-title>
        <h3 class='text-danger'>Nhắc nhở</h3>
      </template>
      <div class="text-center">
        <i class="fa fa-exclamation-triangle text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn xóa người dùng <strong>{{ userName }}</strong> này không?</p>
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
        confirmDelete(event) {
          event.preventDefault();
          axios.delete(`/users/${this.userId}`).then(response => {
            this.showModal = false;
            this.$emit('delete-confirmed'); 
          });
            // this.$emit('delete-confirmed');    
        }
  }
};
</script>