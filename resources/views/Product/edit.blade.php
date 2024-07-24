@include('includes.header')
<body>
    <div class="container">
        @include('Product.navbar')
        <div class="row tittle pt-2">
            <p class="float-left col-8 pl-0">Chỉnh sửa sản phẩm</p>
            <div class="col-4">
            <a href="{{ route('product.index') }}" class="float-left pr-1">Sản phẩm </a>
            <span>> Chỉnh sửa sản phẩm</span>
            </div>
        </div>
        <form  class="form float-left mt-2 pb-5" style="width:100%;" method="POST" action="{{ route('product.update',$product->product_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="float-left p-0" style="width:50%;">
                <label for="product_name" class="lbl"> Tên sản phẩm </label>
                <input type="text" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm" class="form-control" value="{{ $product->product_name }}">
                @if ($errors->has('product_name'))
                <span class="text-danger">{{ $errors->first('product_name') }}</span>
                @endif
                <br>
                <label for="product_price" class="lbl pt-2">Giá bán</label>
                <input type="text" name="product_price" id="product_price" placeholder="Nhập giá bán" class="form-control" value="{{ $product->product_price }}">
                @if ($errors->has('product_price'))
                <span class="text-danger">{{ $errors->first('product_price') }}</span>
                @endif
                <br>
                <label for="description" class="lbl pt-2">Mô tả</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <br>
                <label for="is_sales" class="lbl pt-2">Trạng thái</label>
                <select name="is_sales" id="is_sales" class="form-control custom-select">
                    <option value="0" {{ $product->is_sales == 0 ? 'selected' : '' }}>Ngừng bán</option>
                    <option value="1" {{ $product->is_sales == 1 ? 'selected' : '' }}>Đang bán</option>
                </select>
                @if ($errors->has('is_sales'))
                <span class="text-danger">{{ $errors->first('is_sales') }}</span>
                @endif
            </div>
            <div class="float-left pl-4" style="width:50%;">
                <label for="product_image" class="lbl">Hình ảnh</label>
                <div class=" images mb-5" >
                    <img src="{{ asset('storage/'. $product->product_image) }}" alt="Hình ảnh sản phẩm" id="imagePreview" style="height: 390px; width:100%;">
                </div>
                <label class="btn btn-success mt-2" for="product_image">Upload images</label>
                <input type="button" class="btn btn-danger" onclick="removeImage()" value="Xóa images" id="remove_image_button"> 
                <input type="hidden" name="remove_image" id="remove_image" value="0"> <!-- Giá trị mặc định -->
                <input hidden type="file" name="product_image" id="product_image" accept="image/*" onchange="uploadImage()">
                <input type="text" name="tenfile" id="tenfile" readonly style="border: 1px solid rgb(152, 151, 151);" placeholder="tên file">
                <br>
                @if ($errors->has('product_image'))
                <span class="text-danger">{{ $errors->first('product_image') }}</span>
                @endif
                <button type="submit" class="btn btn-danger float-right mt-5 ml-3" style="border-radius:0px 0px;">Cập nhật</button>
                <button class="btn btn-dark float-right mt-5" style="border-radius:0px 0px;"><a href="{{ route('product.index') }}" style="color: white; text-decoration: none;">Hủy</a></button>
            </div>
           
        </form>
    </div>
    <script src="{{ asset('js/addproduct.js') }}"></script>
</body>
</html>