<template>
    <form class="row form mt-2 float-left" id="search-form">
        <div class="col-lg-3 form-group search-name">
            <label for="product_name">Tên sản phẩm</label>
            <input type="text" name="product_name" id="product_name" v-model="search.product_name" placeholder="Nhập tên sản phẩm" class="form-control" style="border-radius: 0px;">
        </div>
        <div class="col-lg-3 form-group search-name float-left pl-5">
            <label for="is_sales">Trạng thái</label>
            <select name="is_sales" id="is_sales" v-model="search.is_sales" class="form-select form-control custom-select" style="border-radius: 0px;">
                <option value="">Chọn trạng thái</option>
                <option value="1">Đang bán</option>
                <option value="0">Ngừng bán</option>
            </select>
        </div>
        <div class="col-lg-3 form-group search-name">
            <label for="product_price_to">Giá bán từ</label>
            <input type="text" name="product_price_to" id="product_price_to" v-model="search.product_price_to" class="form-control" style="border-radius: 0px;"> 
        </div>
        <div class="col-lg-3 form-group search-name">
            <label for="product_price_end">Giá bán đến</label>
            <input type="text" name="product_price_end" id="product_price_end" v-model="search.product_price_end" class="form-control" style="border-radius: 0px;"> 
        </div>
    </form>
    <div class="row mt-3">
        <div class="col-lg-6 add-product pl-0">
            <i class="fa fa-user-plus text-primary me-1" aria-hidden="true"></i>
            <button type="button" id="add" name="add" class="btn btn-primary"><a href="/product/add" class="add-a">Thêm mới</a></button>
        </div>
        <div class="col-lg-3">
                <button type="button" class="btn btn-search btn-primary" @click="searchProduct"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
        </div>
        <div class="col-lg-3">
                <button type="button" class="btn btn-search btn-success" @click="cleanSearch"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7" id="pagination-wrapper" v-if="products.total>20">
            <div class="pt-3 pl-0 pagination" id="pagination1"> 
                <a href="#" style="text-decoration: none;" class="prev-page" @click.prevent="changePage(products.current_page - 1)" :disabled = "products.current_page === 1">&laquo;</a>
                <a href="#" v-for="page in numberPage" :key="page" class="page-link" @click.prevent="changePage(page)" :class="{'active': products.current_page === page,'current': products.current_page ===  page}" style="line-height:20px; ">{{page}}</a>
                <a href="#" style="text-decoration: none;" class="next-page" @click.prevent="changePage(products.current_page + 1)" :disabled = "products.current_page === products.last_page">&raquo;</a>
            </div>
        </div>
        <p class="col-lg-5 pt-5 text-center float-right " style="font-size: 14px;">Hiển thị từ {{ (products.current_page -1) * products.per_page +1 }} đến {{ ((products.current_page -1) * products.per_page + 1) + products.data.length - 1 }} trong tổng số <strong>{{ products.total }}</strong> người dùng</p>
    </div>
    <div class="row">
        <table class="table table-striped mt-3">
            <thead class="thead-danger">
                <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Tình trạng</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <tr v-for="(product,index) in products.data" :key="product.id">
                    <td>{{ (products.current_page - 1) * 20 + index + 1 }}</td>
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.product_price }}</td>
                    <td :class="statusClass(product.is_sales)">{{ statusText(product.is_sales) }}</td>
                    <td>
                        <a @click.prevent="editProduct(product)" class="btn update mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <button  class="btn delete mr-1 deleteProduct" data-id="${product.product_id}" data-name="${product.product_name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <p v-if="products.total === 0">Không có dữ liệu</p>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: { data: [] },
            search: {
                product_name: '',
                is_sales: '',
                product_price_to: '',
                product_price_end: ''
            },
            isEdit: false,
            productId: null
        }
    },
    methods: {
        editProduct(product) {
            window.location.href = `/product/add?isEdit=true&productId=${product.product_id}`;
        },
        searchProduct(page = 1) {
            axios.get('/product/list',{ params: { ...this.search, page} }).then(response => {
                this.products = response.data;
            });
        },
        cleanSearch() {
            this.search = { product_name: '', is_sales: '', product_price_to: '', product_price_end: ''};
            this.searchProduct();
        },
        statusClass(is_sales) {
            switch(is_sales) {
                case 0:
                    return 'text-danger';
                case 1:
                    return 'text-success';
            }
        },
        statusText(isActive) {
            switch (isActive) {
                case 0:
                    return 'Ngừng bán';
                case 1:
                    return 'Đang bán';
                default:
                    return 'Không xác định';
            }
        },
        changePage(page) {
            if(page > 0 && page <= this.products.last_page){
                this.searchProduct(page);
            }
        },

    },
    created() {
        this.searchProduct();
    },
    computed: {
        numberPage() {
            let range = [];
            for(let i=1; i<= this.products.last_page; i++)
            {
                range.push(i);
            }
            return range;
        }
    }
}
</script>