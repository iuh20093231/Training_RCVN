<template>
    <b-modal v-model="internalShow" @ok="handleOk" @hide="closeModal" title="Thêm khách hàng" ok-title="Lưu" cancel-title="Hủy">
        <template #modal-header-close>
            <button type="button" class="close" @click="closeModal">&times;</button>
        </template>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="name" class="lbl">Tên</label>
                    <input type="text" class="form-control mt-2" v-model="customer.customer_name" placeholder="Nhập họ tên">
                    <span v-if="errors.customer_name" class="text-danger" style="font-weight: bold;">{{ errors.customer_name[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="email" class="mt-2 lbl">Email</label>
                    <input type="text" id="email" class="form-control mt-2" style="border-radius: 0px;" v-model="customer.email" placeholder="Nhập email">
                    <span v-if="errors.email" class="text-danger" style="font-weight: bold;">{{ errors.email[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="tel_num" class="mt-2 lbl">Số điện thoại</label>
                    <input type="text"  class="form-control mt-2" style="border-radius: 0px;" v-model="customer.tel_num" placeholder="Nhập số điện thoại">
                    <span v-if="errors.tel_num" class="text-danger" style="font-weight: bold;">{{ errors.tel_num[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="address" class="lbl mt-2">Địa chỉ</label>
                    <input type="text"  class="form-control mt-2" style="border-radius: 0px;" v-model="customer.address" placeholder="Nhập địa chỉ">
                    <span v-if="errors.address" class="text-danger" style="font-weight: bold;">{{ errors.address[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="is_active" class="mt-2 lbl pe-5">Trạng thái</label>
                    <input type="checkbox" id="is_active"  class="mt-2" v-model="customer.is_active">
                    <label for="is_active" class="ps-2">Trạng thái hoạt động</label>
                </div>
            </form>
        </div>
    </b-modal>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        show: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            internalShow: this.show,
            customer: {
                customer_name: '',
                email: '',
                tel_num: '',
                address: '',
                is_active: false
            },
            errors: {}
        };
    },
    methods: {
        handleOk() {
            this.addCustomer().then(() => {
                this.closeModal();
            });
        },
        addCustomer() {
            axios.post('/custormer/add', this.customer).then(response => {
                this.resetForm();
                this.$emit('customer_add', response.data);
                this.$emit('close-modal');
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        },
        resetForm() {
            this.customer = {
                customer_name: '',
                email: '',
                tel_num: '',
                address: '',
                is_active: false
            };
            this.errors = {};
        },
        closeModal() {
            this.internalShow = false; 
            this.$emit('update:show', false); 
            this.$emit('close-modal');
            this.resetForm();
        }
    },
    watch: {
        show(newVal) {
            this.internalShow = newVal;
        }
    }
};
</script>