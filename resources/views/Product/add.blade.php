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
        <form  class="form float-left mt-2 pb-5" style="width:100%;" method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="float-left p-0" style="width:50%;">
                <label for="product_name" class="lbl"> Tên sản phẩm </label>
                <input type="text" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm" class="form-control" value="{{ old('product_name') }}">
                @if ($errors->has('product_name'))
                <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
                <br>
                <label for="product_price" class="lbl pt-2">Giá bán</label>
                <input type="text" name="product_price" id="product_price" placeholder="Nhập giá bán" class="form-control" value="{{ old('product_price') }}">
                @if ($errors->has('product_price'))
                <span class="text-danger">{{ $errors->first('product_price') }}</span>
                @endif
                <br>
                <label for="description" class="lbl pt-2">Mô tả</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <br>
                <label for="is_sales" class="lbl pt-2">Trạng thái</label>
                <select name="is_sales" id="is_sales" class="form-control custom-select">
                    <option value="0" {{ old('is_sales') == 0 ? 'selected' : '' }}>Ngừng bán</option>
                    <option value="1" {{ old('is_sales') == 1 ? 'selected' : '' }}>Đang bán</option>
                </select>
                @if ($errors->has('is_sales'))
                    <span class="text-danger">{{ $errors->first('is_sales') }}</span>
                @endif
            </div>
            <div class="float-left pl-4" style="width:50%;">
                <label for="product_image" class="lbl">Hình ảnh</label>
                <div style="height: 350px; border: 1px solid black;" class="mb-5" >
                    <img src="" alt="Hình ảnh sản phẩm" id="imagePreview" style="height: 340px; width:100%;">
                </div>
                <label class="btn btn-success mt-2" for="product_image">Upload images</label>
                <button type="button" class="btn btn-danger"  onclick="removeImage()"> Xóa images</button>
                <input hidden type="file" name="product_image" id="product_image" accept="image/*" onchange="uploadImage()">
                <input type="text" name="tenfile" id="tenfile" readonly style="border: 1px solid rgb(152, 151, 151); width:auto; height:35px;" placeholder="tên file upload" class="ml-0">
                <br>
                @if ($errors->has('product_image'))
                <span class="text-danger">{{ $errors->first('product_image') }}</span>
                @endif
                <button type="submit" class="btn btn-danger float-right mt-3 ml-3" style="border-radius:0px 0px;">Lưu</button>
                <button class="btn btn-dark float-right mt-3" style="border-radius:0px 0px;"><a href="{{ route('product.index') }}" style="color: white; text-decoration: none;">Hủy</a></button>
            </div>  
        </form>
    </div>
    <script src="{{ asset('js/addproduct.js') }}"></script>
</body>
</html>