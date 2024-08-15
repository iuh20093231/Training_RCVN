<template>
    <b-modal id="confirm-delete-modal" v-model="showModal" hide-header-close>
      <template #title>
        <h3 class="text-center"><strong>Nhắc nhở</strong></h3>
      </template>
      <div class="text-center">
        <i class="fa fa-exclamation-triangle text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn xóa sản phẩm <strong>{{ productId }}</strong> này không?</p>
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
        showModal: false, 
        productId: null
        };
    },
    methods: {
        show(productId) {
            this.productId = productId;
            this.showModal = true;
        },
        resetModal() {
            this.productId = null;
            this.showModal = false;
        },
        confirmDelete() {
            axios.delete(`/product/${this.productId}`).then(response => {
              this.showModal = false;
              location.reload();
            });           
        }
  }
};
</script>