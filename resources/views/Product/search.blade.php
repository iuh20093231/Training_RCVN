<form class="row form mt-2 float-left" id="search-form">
    <div class="col-lg-3 form-group search-name float-left">
        <label for="product_name">Tên sản phẩm</label>
        <input type="text" name="product_name" id="product_name" placeholder="Nhập tên sản phẩm" class="form-control">
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="is_sales">Trạng thái</label>
        <select name="is_sales" id="is_sales" class="form-control custom-select" style="width:200px;">
            <option value="">Chọn trạng thái</option>
            <option value="1">Đang bán</option>
            <option value="0">Ngừng bán</option>
        </select>
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="product_price_to">Giá bán từ</label>
        <input type="text" name="product_price_to" id="product_price_to" class="form-control"> 
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="product_price_end">Giá bán đến</label>
        <input type="text" name="product_price_end" id="product_price_end" class="form-control"> 
    </div>
<div class="add-product pl-0">
        <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
        <button type="submit" id="add" name="add" class="btn btn-primary"><a href="{{ route('product.create') }}" class="add-a">Thêm mới</a></button>
</div>
<div class="float-right ml-5">
        <button type="button" class="btn btn-search btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
</div>
<div class="float-right ml-5">
        <button type="button" class="btn btn-search btn-success" id="clear-search"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
</div>
</form>