<template>
    <b-modal id="confirm-delete-modal" v-model="showModal" hide-header-close>
      <template #title>
        <h3 class="text-center"><strong>Nhắc nhở</strong></h3>
      </template>
      <div class="text-center">
        <i class="fa fa-exclamation-triangle text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn xóa khách hàng <strong>{{ customerName }}</strong> này không?</p>
      </div>
      <template #footer>
            <b-button variant="secondary" @click="resetModal">Hủy</b-button>
            <b-button variant="danger" @click="confirmDelete">OKay</b-button>
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
        customerName: '',
        showModal: false, 
        customerID: null
        };
    },
    methods: {
        show(customerName, customerID) {
          this.customerName = customerName;
          this.customerID = customerID;
          this.showModal = true;
        },
        resetModal() {
          this.customerName = '';
          this.customerID = null;
          this.showModal = false;
        },
        confirmDelete() {
            axios.delete(`/custormer/${this.customerID}`);
            this.showModal = false;
            location.reload();
        }
  }
};
</script>