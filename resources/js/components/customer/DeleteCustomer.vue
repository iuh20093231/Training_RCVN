<template>
    <b-modal id="confirm-delete-modal" v-model="showModal" hide-header-close centered size="md" no-close-on-esc no-close-on-backdrop>
      <template #title>
        <h4 class="text-center text-danger fw-bold">NHẮC NHỞ</h4>
      </template>
      <div class="text-center">
        <i class="fas fa-exclamation-circle text-danger" style="font-size: 60px;"></i>
        <p class="mt-3 text-dark fw-bold">Bạn có chắc chắn muốn xóa khách hàng <strong class="text-danger">{{ customerName }}</strong>?</p>
        <p class="text-muted mb-3">Thao tác này không thể khôi phục.</p>
      </div>
      <template #footer>
        <div class="d-flex justify-content-center">
          <b-button variant="outline-secondary" class="px-3 py-2" @click="resetModal">Hủy</b-button>
          <b-button variant="danger" class="px-3 py-2 ms-2" @click="confirmDelete">
            <i class="fas fa-check me-2"></i> Xóa
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
            axios.delete(`/custormer/${this.customerID}`).then(response => {
              this.showModal = false;
              location.reload();
            });
        }
  }
};
</script>