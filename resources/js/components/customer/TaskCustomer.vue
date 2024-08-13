<template>
    <form class="form mt-2" id="search-form" method="GET" enctype="multipart/form-data" >
        <div class="row pl-0">
            <div class="col-lg-3 form-group search-name">
                <label for="customer_name">Họ và tên</label>
                <input type="text" name="customer_name" id="customer_name" v-model="find.customer_name" @keydown.enter="searchCustomer" placeholder="Nhập họ tên" class="form-control mt-1" style="border-radius: 0px;">
            </div>
            <div class="col-lg-3 form-group search-name">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" v-model="find.email" placeholder="Nhập email" @keydown.enter="searchCustomer" class="form-control mt-1" style="border-radius: 0px;">
            </div>
            <div class="col-lg-3 form-group search-name">
                <label for="is_active">Trạng thái</label>
                <select name="is_active" id="is_active" v-model="find.is_active" class="form-select form-control custom-select mt-1" style="border-radius: 0px;" @keydown.enter="searchCustomer">
                    <option value="">Chọn trạng thái</option>
                    <option value="1">Hoạt động</option>
                    <option value="0">Không hoạt động</option>
                </select> 
            </div>
            <div class="col-lg-3 form-group search-name">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" v-model="find.address" placeholder="Nhập địa chỉ" class="form-control mt-1" style="border-radius: 0px;" @keydown.enter="searchCustomer">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                <i class="fa fa-user-plus text-primary me-1" aria-hidden="true"></i>
                <button type="button" id="add" name="add" class="btn btn-primary" style="font-weight: bold;" @click="showModal = true">Thêm mới</button>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-search btn-primary" @click="searchCustomer"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-search btn-success" @click="clearSearch"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
            </div>
            <div class="col-lg-3">
                <i class="fa fa-download text-success" style="margin-right: 10px;" aria-hidden="true"></i>
                <button type="button" class="btn btn-success" style="font-weight: bold;" id="export" @click="exportCSV">Export CSV</button>
            </div>
            <div class="col-lg-3">
                <i class="fa fa-upload  text-success" style="margin-right: 10px;" aria-hidden="true"></i>
                <button  class="btn btn-success" type="button" style="font-weight: bold;" @click="triggerFileInput">Import CSV</button>
            </div>
        </div>
    </form>
    <form method="POST" enctype="multipart/form-data" class="form mt-3" id="import-form">
        <input type="file" name="file" id="file-input" style="display: none;" accept=".csv" @change="handleFile">
    </form>
    <div v-if="importErrors.length" class="alert alert-danger">
            <div v-for="(error, index) in importErrors" :key="index">
                <p>Lỗi tại hàng <strong>{{ error.row }}</strong>:</p>
                <ul>
                    <li v-for="(msg, idx) in error.errors" :key="idx">{{ msg }}</li>
                </ul>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-7" id="pagination-wrapper" v-if="customers.total>20">
            <div class="pt-3 pl-0 pagination" id="pagination1"> 
                <a href="#" style="text-decoration: none;" class="prev-page" @click.prevent="changePage(customers.current_page - 1)" :disabled = "customers.current_page === 1">&laquo;</a>
                <a href="#" v-for="page in numberPage" :key="page" class="page-link" @click.prevent="changePage(page)" :class="{'active': customers.current_page === page,'current': customers.current_page ===  page}" style="line-height:20px;">{{page}}</a>
                <a href="#" style="text-decoration: none;" class="next-page" @click.prevent="changePage(customers.current_page + 1)" :disabled = "customers.current_page === customers.last_page">&raquo;</a>
            </div>
        </div>
        <p class="col-lg-5 pt-5 text-center float-end " style="font-size: 14px;">Hiển thị từ {{ (customers.current_page -1) * customers.per_page +1 }} đến {{ ((customers.current_page -1) * customers.per_page + 1) + customers.data.length - 1 }} trong tổng số <strong>{{ customers.total }}</strong> người dùng</p>
    </div> 
    <div class="row">
        <table class="table table-striped mt-2">
            <thead class="thead-danger">
            <tr>
                <th class="bg-danger text-white">#</th>
                <th class="bg-danger text-white">Họ tên</th>
                <th class="bg-danger text-white">Email</th>
                <th class="bg-danger text-white">Địa chỉ</th>
                <th class="bg-danger text-white">Điện thoại</th>
                <th class="bg-danger text-white">Action</th>
            </tr>
            </thead>
            <tbody id="user-table">
                <tr v-for="(customer,index) in customers.data" :key="customer.id">
                    <td>{{ (customers.current_page - 1) * 20 + index + 1 }}</td>
                    <td>
                        <input v-if="editID === customer.id" v-model="customer.customer_name"  class="form-control"/>
                        <span v-else>{{ customer.customer_name }}</span>
                        <div v-if="errors[customer.id]?.customer_name" class="error text-danger">{{ errors[customer.id].customer_name }}</div>
                    </td>
                    <td>
                        <input v-if="editID === customer.id" type="email" v-model="customer.email"  class="form-control"/>
                        <span v-else>{{ customer.email }}</span>
                        <div v-if="errors[customer.id]?.email" class="error text-danger">{{ errors[customer.id].email }}</div>
                    </td>
                    <td>
                        <input v-if="editID === customer.id" type="email" v-model="customer.address"  class="form-control"/>
                        <span v-else>{{ customer.address }}</span>
                        <div v-if="errors[customer.id]?.address" class="error text-danger">{{ errors[customer.id].address }}</div>
                    </td>
                    <td>
                        <input v-if="editID === customer.id" type="email" v-model="customer.tel_num"  class="form-control"/>
                        <span v-else>{{ customer.tel_num }}</span>
                        <div v-if="errors[customer.id]?.tel_num" class="error text-danger">{{ errors[customer.id].tel_num }}</div>
                    </td>
                    <td>
                        <button v-if="editID === customer.id" class="btn btn-success" @click="updateCustomer(customer.id)">Lưu</button>
                        <button v-else type="button" name="update" class="btn text-primary edit-customer" @click="editTask(customer)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button class="btn text-danger mr-1 deleteCustomer"><i class="fa fa-trash" aria-hidden="true" @click="showConfirmDeleteModal(customer.customer_name,customer.id)"></i></button>
                    </td>
                </tr>
                <p v-if="customers.total === 0">Không có dữ liệu</p>
            </tbody>
        </table>
    </div>
    <add-customer v-model:show="showModal" @customer-add="searchCustomer" @close-modal="closeModal"></add-customer>
    <delete-customer ref="confirmDeleteModal" @delete-confirmed="searchCustomer"></delete-customer>
</template>
<script>
import axios from 'axios';
import AddCustomer from './AddCustomer.vue';
import DeleteCustomer from './DeleteCustomer.vue'
export default {
  components: { AddCustomer, DeleteCustomer },
    data() {
        return {
            customers: { data: [] },
            find: {
                customer_name: '',
                email: '',
                is_active: '',
                address: '',
            },
            editID: null,
            errors: {},
            showModal: false,
            importErrors: []
        }
    },
    methods: {
        searchCustomer(page = 1) {
            axios.get('/custormer/list',{ params: {...this.find , page} }).then(response => {
                this.importErrors = [];
                this.customers = response.data;
            });
        },
        clearSearch() {
            this.find = {customer_name:'',email: '', is_active: '', address:''};
            this.importErrors = [];
            this.searchCustomer();
        },
        changePage(page) {
            if(page > 0 && page <= this.customers.last_page){
                this.searchCustomer(page);
            }
        },
        editTask(customer) {
            this.editID = customer.id;
        },
        updateCustomer(id) {
            const customer = this.customers.data.find(customer => customer.id === id);
            const data = {
                customer_name: customer.customer_name,
                email: customer.email,
                address: customer.address,
                tel_num: customer.tel_num
            };
            axios.put(`/custormer/${id}`, data).then(()=>{
                this.editID = null;
                this.errors = {};
                this.importErrors = [];
                this.searchCustomer();
            }).catch(error => {
                if (error.response && error.response.data.errors) {
                    this.errors[customer.id] = error.response.data.errors;
                }
            });
        },
        closeModal() {
            this.showModal = false;  
            this.searchCustomer();
        },
        showConfirmDeleteModal(customerName, customerID) {
            if (this.$refs.confirmDeleteModal) {
                this.$refs.confirmDeleteModal.show(customerName, customerID);
            } else {
                console.error('Errors delete');
            }
        },
        exportCSV() {
            const params = new URLSearchParams(this.find).toString();
            window.location.href = `/export?${params}`;
        },
        importCSV(file) {
            const formData = new FormData();
            formData.append('file', file);
            axios.post('/import',formData,{
                headers: {
                'Content-Type': 'multipart/form-data',
                }
            }).then(response => {
                this.importErrors = [];
                this.searchCustomer();
            }).catch (error => {
                console.log('lỗi nhận được', error.response.data.errors);
                if (error.response && error.response.data.errors) {
                    this.importErrors = error.response.data.errors;
                } else {
                    this.importErrors = [{ row: 'N/A', errors: ['Lỗi không xác định'] }];
                }
            });
        },
        handleFile(event) {
            const file = event.target.files[0];
            this.importCSV(file);
        },
        triggerFileInput() {
        document.getElementById('file-input').click();
        }
    },
    created() {
        this.searchCustomer();
    },
    computed: {
        numberPage() {
            let range = [];
            for(let i=1; i<= this.customers.last_page; i++)
            {
                range.push(i);
            }
            return range;
        }
    }
};
</script>