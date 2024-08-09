<template>
    <div class="row tittle pt-2">
            <p class="float-start col-8 pl-0">{{ isEdit ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm' }}</p>
            <div class="col-4">
            <a href="/product" class="float-start pe-1">Sản phẩm </a>
            <span>{{ isEdit ? '> Chỉnh sửa sản phẩm' : '> Thêm sản phẩm'}}</span>
            </div>
    </div>
    <form class="form float-start mt-2 pb-5" style="width:100%;" @submit.prevent="handleOK">
            <div class="float-start p-0" style="width:50%;">
                <label for="product_name" class="lbl"> Tên sản phẩm </label>
                <input type="text" name="product_name" id="product_name" v-model="product.product_name" placeholder="Nhập tên sản phẩm" class="form-control mt-2">
                <span v-if="errors.product_name" class="text-danger" style="font-weight: bold;">{{ errors.product_name[0] }}</span><br>
                <label for="product_price" class="lbl">Giá bán</label>
                <input type="text" name="product_price" id="product_price" v-model="product.product_price" placeholder="Nhập giá bán" class="form-control mt-2">
                <span v-if="errors.product_price" class="text-danger" style="font-weight: bold;">{{ errors.product_price[0] }}</span><br>
                <label for="description" class="lbl">Mô tả</label>
                <textarea name="description" id="description" cols="30" rows="10" v-model="product.description" class="form-control mt-2"></textarea>
                <label for="is_sales" class="lbl">Trạng thái</label>
                <select name="is_sales" id="is_sales" v-model="product.is_sales" class="form-select form-control mt-2">
                    <option value="">Chọn trạng thái</option>
                    <option value="0">Ngừng bán</option>
                    <option value="1">Đang bán</option>
                </select>
            </div>
            <div class="float-start ps-4" style="width:50%;">
                <label for="product_image" class="lbl">Hình ảnh</label>
                <div style="height: 350px; border: 1px solid black;" class="mt-2 mb-5" >
                    <img :src="product.imageUrl" alt="Hình ảnh sản phẩm" id="imagePreview" style="height: 340px; width:100%;">
                </div>
                <label class="btn btn-success" for="product_image">Upload images</label>
                <button type="button" class="btn btn-danger ms-2" @click="removeImage"> Xóa images</button>
                <input hidden type="file" ref="imageInput" name="product_image" id="product_image" accept="image/*" @change="uploadImage">
                <input type="text" name="tenfile" id="tenfile" :value="fileName"  style="border: 1px solid rgb(152, 151, 151); width:auto; height:35px;" placeholder="tên file upload" class="ms-2" readonly><br>
                <span v-if="errors.product_image" class="text-danger" style="font-weight: bold;">{{ errors.product_image[0] }}</span><br>
                <button type="submit" class="btn btn-danger float-end mt-3 ms-3" style="border-radius:0px 0px;">Lưu</button>
                <button type="button" class="btn btn-dark float-end mt-3" style="border-radius:0px 0px;" @click="handleCancel">Hủy</button>
            </div>  
        </form>
</template>
<script>
import axios from 'axios';
export default {
    data () {
        return {
            product: {
                product_name: '',
                product_price: '',
                description: '',
                is_sales: '',
                image: null,
                imageUrl: '',
            },
            errors: {},
            fileName: '',
            isEdit: false,
            productId: null
        };
    },
    created() {
        const urlParams = new URLSearchParams(window.location.search);
        this.isEdit = urlParams.get('isEdit') === 'true';
        this.productId = urlParams.get('productId');
        if (this.isEdit && this.productId) {
            this.getProductDetails();
        }
    },
    methods: {
        getProductDetails() {
            axios.get(`/product/${this.productId}/edit`).then(response => {
                const product = response.data;
                this.product.product_name = product.product_name;
                this.product.product_price = product.product_price;
                this.product.description = product.description;
                this.product.is_sales = product.is_sales;
                this.product.imageUrl = product.product_image ? `/storage/${product.product_image}` : '';
            }).catch(error => {
                 console.log(error);
            });
        },
        uploadImage(event) {
            const file = event.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.product.imageUrl = e.target.result;
                    this.fileName = file.name;
                    this.product.image = file;
                };
                reader.readAsDataURL(file);
            }
        },
        removeImage() {
            this.product.image = null;
            this.product.imageUrl = '';
            this.fileName = '';
            this.$refs.imageInput.value = '';
        },
        handleOK() {
            if(this.isEdit) {
                this.updateProduct();
            } else {
                this.addProduct();
            }
        },
        addProduct() {
            const formData = new FormData();
            formData.append('product_name', this.product.product_name);
            formData.append('product_price', this.product.product_price);
            formData.append('description', this.product.description);
            formData.append('is_sales', this.product.is_sales);
            if (this.product.image) {
                formData.append('product_image', this.product.image);
            }
            axios.post('/product/add',formData).then(response => {
                window.location.href = '/product';
            }).catch(error => {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
            });
        
        },
        updateProduct() {
            const formData = new FormData();
            formData.append('product_name', this.product.product_name);
            formData.append('product_price', this.product.product_price);
            formData.append('description', this.product.description);
            formData.append('is_sales', this.product.is_sales);
            if (this.product.image) {
                formData.append('product_image', this.product.image);
            } 
            axios.post(`/product/${this.productId}`,formData,{
                        headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                window.location.href = '/product';
            }).catch(error => {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    console.log(error.response.data.errors);
                }
            });
        },
        handleCancel() {
            window.location.href = '/product';
        }
    }

}
</script>