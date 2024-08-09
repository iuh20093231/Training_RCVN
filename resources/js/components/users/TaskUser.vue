<template>
    <form class="row form mt-2">
        <div class="col-lg-3 form-group search-name float-left pl-0">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" v-model="search.name" placeholder="Nhập họ tên" class="form-control">
        </div>
        <div class="col-lg-3 form-group search-name float-left">
            <label for="email">Email</label>
            <input type="text" name="email" v-model="search.email" placeholder="Nhập email" class="form-control" style="border-radius: 0px;">
        </div>
        <div class="col-lg-3 form-group search-name float-left">
            <label for="group_role">Nhóm</label>
            <select name="group_role" id="group_role" v-model="search.group_role" class="form-select form-control" style="border-radius: 0px;">
                <option value="">Chọn nhóm</option>
                <option value="Reviewer">Reviewer</option>
                <option value="Admin">Admin</option>
                <option value="Editor">Editor</option>
            </select> 
        </div>
        <div class="col-lg-3 form-group search-name float-left">
            <label for="is_active">Trạng thái</label>
            <select name="is_active" id="is_active" v-model="search.is_active" class="form-select form-control" style="border-radius: 0px;">
                <option value="">Chọn trạng thái</option>
                <option value="1">Đang hoạt động</option>
                <option value="0">Tạm khóa</option>
            </select> 
        </div>
    </form>
    <div class="row mt-3">
        <div class="col-lg-6 add-product">
            <i class="fa fa-user-plus text-primary me-1" aria-hidden="true"></i>
            <button type="button" id="add" name="add" class="btn btn-primary" @click="showModalAdd">Thêm mới</button>
        </div>
        <div class=" col-lg-3">
            <button type="button" class="btn btn-search btn-primary" @click="searchUsers" ><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
        </div>
        <div class="col-lg-3">
            <button type="button" class="btn btn-search btn-success" @click="clearSearch" ><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7" id="pagination-wrapper" v-if="users.total>20">
            <div class="pt-3 pl-0 pagination" id="pagination1"> 
                <a href="#" style="text-decoration: none;" class="prev-page" @click.prevent="changePage(users.current_page - 1)" :disabled = "users.current_page === 1">&laquo;</a>
                <a href="#" v-for="page in numberPage" :key="page" class="page-link" @click.prevent="changePage(page)" :class="{'active': users.current_page === page,'current': users.current_page ===  page}" style="line-height:20px; ">{{page}}</a>
                <a href="#" style="text-decoration: none;" class="next-page" @click.prevent="changePage(users.current_page + 1)" :disabled = "users.current_page === users.last_page">&raquo;</a>
            </div>
        </div>
        <p class="col-lg-5 pt-5 text-center float-right " style="font-size: 14px;">Hiển thị từ {{ (users.current_page -1) * users.per_page +1 }} đến {{ ((users.current_page -1) * users.per_page + 1) + users.data.length - 1 }} trong tổng số <strong>{{ users.total }}</strong> người dùng</p>
    </div>
    <div class="row">
        <table class="table table-striped mt-1">
            <thead>
                <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <tr v-for="(user,index) in users.data" :key="user.id">
                    <td>{{ (users.current_page - 1) * 20 + index + 1 }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.group_role }}</td>
                    <td :class="statusClass(user.is_active)">{{ statusText(user.is_active) }}</td>
                    <td>
                        <button class="btn text-primary mr-1" @click="showModalUpdate(user)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button  class="btn text-danger mr-1" @click="showConfirmDeleteModal(user.name, user.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button  class="btn mr-1" @click="showConfirmLockUpModal(user.name,user.id)"><i class="fa fa-user-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <p v-if="users.total === 0">Không có dữ liệu</p>
            </tbody>
        </table>
    </div>
    <AddUser v-model:show="showModal" :user-to-edit="seclectedUsers" @user-added="searchUsers" @user-updated="handelUpdate(users)" @close-modal="closeModal"></AddUser>
    <delete ref="confirmDeleteModal" @delete-confirmed="searchUsers"></delete>
    <lock-up ref="confirmLockupModal" @lockup-confirmed="searchUsers"></lock-up>
</template>
<script>
import axios from 'axios';
import Delete from './Delete.vue';
import LockUp from './LockUp.vue';
import AddUser from './AddUser.vue';
export default {
    components: {
        Delete,
        LockUp,
        AddUser
    },
    data() {
        return {
            users: { data: [] },
            search: {
                name: '',
                email: '',
                group_role: '',
                is_active: ''
            },
            showModal: false,
            seclectedUsers: null
        };
    },
    methods: {
        showModalAdd() {
            this.showModal = true;
        },
        showModalUpdate(user) {
            this.seclectedUsers = {...user};
            this.showModal = true;
        },
        searchUsers(page = 1) {
            axios.get('/users/list',{ params: { ...this.search, page} }).then(response => {
                this.users = response.data;
            });
        },
        showConfirmDeleteModal(userName, userId) {
            if (this.$refs.confirmDeleteModal) {
                this.$refs.confirmDeleteModal.show(userName, userId);
            } else {
                console.error('Errors delete');
            }
        },
        showConfirmLockUpModal(userName, userId) {
            if (this.$refs.confirmLockupModal) {
                this.$refs.confirmLockupModal.show(userName, userId);
            } else {
                console.error('Errors lockup');
            }
        },
        clearSearch() {
            this.search = { name: '', email: '', group: '', status: '' };
            this.searchUsers();
        },
        statusClass(is_active) {
            switch(is_active) {
                case 0:
                    return 'text-danger';
                case 1:
                    return 'text-success';
            }
        },
        statusText(isActive) {
            switch (isActive) {
                case 0:
                    return 'Tạm khóa';
                case 1:
                    return 'Đang hoạt động';
                default:
                    return 'Không xác định';
            }
        },
        changePage(page) {
            if(page > 0 && page <= this.users.last_page){
                this.searchUsers(page);
            }
        },
        closeModal() {
            this.showModal = false;
            this.searchUsers();
        },
        handelUpdate(updateUser) {
            const index = this.users.data.findIndex(user => user.id === updateUser.id);
            if(index !== -1) {
                this.users[index] = updatedUser;
            }
        }
    },
    created() {
        this.searchUsers();
    },
    computed: {
        numberPage() {
            let range = [];
            for(let i=1; i<= this.users.last_page; i++)
            {
                range.push(i);
            }
            return range;
        }
    }
};
</script>