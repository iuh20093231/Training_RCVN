<template>
    <b-modal id="confirm-delete-modal" title="Nhắc nhở" @ok="confirmDelete" @hide="resetModal" ok-title="Okay" cancel-title="Hủy" @hidden="resetModal" v-model="showModal">
      <template #modal-title>
        <h3 class='text-danger'>Nhắc nhở</h3>
      </template>
      <div class="text-center">
        <i class="fa fa-exclamation-triangle text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn xóa khách hàng <strong>{{ customerName }}</strong> này không?</p>
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
        },
        confirmDelete() {
            axios.delete(`/custormer/${this.customerID}`);
            this.$emit('delete-confirmed');
            
        }
  }
};
</script>