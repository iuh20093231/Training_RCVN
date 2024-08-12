<template>
    <b-modal id="confirm-delete-modal" title="Nhắc nhở" @ok="confirmDelete" @hide="resetModal" ok-title="Okay" cancel-title="Hủy" @hidden="resetModal" v-model="showModal">
      <template #modal-title>
        <h3 class='text-danger'>Nhắc nhở</h3>
      </template>
      <div class="text-center">
        <i class="fa fa-exclamation-triangle text-warning" style="font-size: 70px;"></i>
        <p class="mt-2 text-danger">Bạn có chắc muốn xóa sản phẩm <strong>{{ productId }}</strong> này không?</p>
      </div>
    </b-modal>
  <!-- <div class='modal fade' id='myModal' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content min-h-65'>
            <div class='modal-body text-center'>
                <div class='icon-status mt-2 p-5'>     
                    <i class="fa fa-exclamation-triangle text-warning " aria-hidden="true" style="font-size: 70px;"></i>
                    <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                    <p class="p">Bạn có chắc muốn xóa người dùng <strong>{{ productId }}</strong> này không?</p>
                </div>
                    <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy' @click="resetModal">
                    <input type='button' class='btn btn-danger mb-3' id="btn-delete" value='Okay' @click="confirmDelete">
                </div>
         </div>
    </div>
  </div> -->
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
        },
        confirmDelete() {
            axios.delete(`/product/${this.productId}`);
            this.$emit('delete-confirmed');            
        }
  }
};
</script>