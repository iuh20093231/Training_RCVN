<template>
    <b-modal v-model="internalShow"  @hide="closeModal" :title="isEditModel ? 'Chỉnh sửa user' : 'Thêm user'" cancel-title="Hủy">
        <template #modal-header-close>
            <button type="button" class="close" @click="closeModal">&times;</button>
        </template>
        <div class="modal-body">
            <form @submit.prevent="handleOk">
                <div class="form-group">
                    <label for="name" class="lbl">Tên</label>
                    <input type="text" id="name" class="form-control mt-2" v-model="user.name" placeholder="Nhập họ tên">
                    <span v-if="errors.name" class="text-danger" style="font-weight: bold;">{{ errors.name[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="email" class="mt-2 lbl">Email</label>
                    <input type="text" id="email" class="form-control mt-2" style="border-radius: 0px;" v-model="user.email" placeholder="Nhập email">
                    <span v-if="errors.email" class="text-danger" style="font-weight: bold;">{{ errors.email[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="password" class="mt-2 lbl">Mật khẩu</label>
                    <input type="password" id="password" class="form-control mt-2" style="border-radius: 0px;" v-model="user.password" placeholder="Mật khẩu">
                    <span v-if="errors.password" class="text-danger" style="font-weight: bold;">{{ errors.password[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="reset_password" class="lbl mt-2">Xác nhận</label>
                    <input type="password" id="reset_password" class="form-control mt-2" style="border-radius: 0px;" v-model="user.reset_password" placeholder="Xác nhận mật khẩu">
                    <span v-if="errors.reset_password" class="text-danger" style="font-weight: bold;">{{ errors.reset_password[0] }}</span>
                </div>
                <div class="form-group">
                    <label for="group_role" class="mt-2 lbl">Chọn nhóm</label>
                    <select id="group_role" class="form-select form-control mt-2" style="border-radius: 0px;" v-model="user.group_role">
                        <option value="Admin">Admin</option>
                        <option value="Reviewer">Reviewer</option>
                        <option value="Editor">Editor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_active" class="mt-2 lbl pe-5">Trạng thái</label>
                    <input type="checkbox" id="is_active"  class="mt-2" v-model="user.is_active" true-value="1" false-value="0">
                    <label for="is_active" class="ps-2">Trạng thái hoạt động</label>
                </div>
            </form>
        </div>
        <template #footer>
            <b-button variant="secondary" @click="closeModal">Hủy</b-button>
            <b-button variant="danger" @click="handleOk">{{ isEditModel ? 'Cập nhật' : 'Lưu' }}</b-button>
        </template>
    </b-modal>
</template>

<script>
import axios from 'axios';
import { BModal, BButton } from 'bootstrap-vue-3';
export default {
    props: {
        show: {
            type: Boolean,
            required: true
        },
        userToEdit: {
            default: () => ({})
        }
    },
    components: {
        BModal,
        BButton
    },
    data() {
        return {
            internalShow: this.show,
            user: {
                name: '',
                email: '',
                password: '',
                reset_password: '',
                group_role: 'Admin',
                is_active: false
            },
            errors: {},
            isEditModel: false
        };
    },
    methods: {
        handleOk() {
            if (this.isEditModel) {
            this.updateUser().then(response => {

            });
        } else {
        this.addUser().then(response => {
           
        });
    }
        },
        addUser() {
            axios.post('/users/add', this.user).then(response => {
                this.resetForm();
                this.$emit('user-added', response.data);
                this.closeModal();
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
                throw error;
            });

        },
        updateUser() {
            axios.put(`/users/${this.user.id}`,this.user).then(response => {
                this.resetForm();
                this.$emit('user-updated',response.data);
                this.closeModal();
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
                throw error;
            })
        },
        resetForm() {
            this.user = {
                name: '',
                email: '',
                password: '',
                reset_password: '',
                group_role: 'Admin',
                is_active: false
            };
            this.errors = {};
            this.isEditModel = false;
        },
        closeModal() {
            this.resetForm();
            this.internalShow = false;
            this.$emit('update:show', false);
            this.$emit('close-modal');
            
        },
        hasErrors() {
            return Object.keys(this.errors).length > 0;
        }
    },
    watch: {
        show(newVal) {
            this.internalShow = newVal;
        },
        userToEdit(newVal) {
            if (Object.keys(newVal).length) {
                this.user = { ...newVal };
                this.isEditModel = true;
                this.internalShow = true;
            }
        }
    }
};
</script>