@include('includes.header')
<body>
    <div class="container">
        @include('Product.navbar')
        <div class="row tittle pt-2">
            <p class="float-left col-8 pl-0">Thêm sản phẩm</p>
            <div class="col-4">
            <a href="{{ route('product.index') }}" class="float-left pr-1">Sản phẩm </a>
            <span>> Thêm sản phẩm</span>
            </div>
        </div>
        <form  class="form float-left mt-2 p-0" style="width:100%;">
            <div class="float-left p-0" style="width:50%;">
                <label for="product_name" class="lbl"> Tên sản phẩm </label>
                <input type="text" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm" class="form-control">
                <label for="product_price" class="lbl pt-2">Giá bán</label>
                <input type="text" name="product_price" id="product_price" placeholder="Nhập giá bán" class="form-control">
                <label for="description" class="lbl pt-2">Mô tả</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                <label for="is_sales" class="lbl pt-2">Trạng thái</label>
                <select name="is_sales" id="is_sales" class="form-control">
                    <option value="">Chọn trạng thái</option>
                    <option value="0">Ngừng bán</option>
                    <option value="1">Đang bán</option>
                </select>
            </div>
            <div class="float-left pl-4" style="width:50%;">
                <label for="product_image" class="lbl">Hình ảnh</label>
                <div style="height: 350px; border: 1px solid black;" class="mb-5"></div>
                <button type="submit" class="btn btn-primary">Upload file</button>
                <button type="submit" class="btn btn-danger"> Xóa file</button>
                <input type="file" name="file" id="file" accept="image/*">
                <button type="submit" class="btn btn-danger float-right mt-3 ml-3" style="border-radius:0px 0px;">Lưu</button>
                <button class="btn btn-dark float-right mt-3" style="border-radius:0px 0px;"><a href="#" style="color: white;">Hủy</a></button>
            </div>
           
        </form>
    </div>
</body>
</html>