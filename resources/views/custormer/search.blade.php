<form class="form" id="search-form" action="{{ route('export') }}" method="GET" enctype="multipart/form-data" >
    @csrf
    <div class="row mb-3">
        <div class="col-lg-3 form-group search-name float-left">
            <label for="customer_name">Họ và tên</label>
            <input type="text" name="customer_name" id="customer_name" placeholder="Nhập họ tên" class="form-control">
        </div>
        <div class="col-lg-3 form-group search-name float-left pl-5">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control">
        </div>
        <div class="col-lg-3 form-group search-name float-left pl-5">
            <label for="is_active">Trạng thái</label>
            <select name="is_active" id="is_active" class="form-control custom-select" style="width:200px;">
                <option value="">Chọn trạng thái</option>
                <option value="1">Hoạt động</option>
                <option value="0">Không hoạt động</option>
            </select> 
        </div>
        <div class="col-lg-3 form-group search-name float-left pl-5">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="form-control">
        </div>
    </div>
    <i class="fa fa-user-plus user-plus m-0" aria-hidden="true"></i>
    <button type="button" id="add" name="add" class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">Thêm mới</button>
    <button type="submit" class="btn btn-search btn-primary ml-5" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
    <button type="button" class="btn btn-search btn-success ml-5" id="clear-search"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
    <i class="fa fa-download import-csv ml-5" aria-hidden="true"></i>
    <button type="button" class="btn btn-success" id="export">Export CSV</button>
    <i class="fa fa-upload import-csv ml-5" aria-hidden="true"></i>
    <button  class="btn btn-success" type="button" onclick="document.getElementById('file-input').click();">Import CSV</button>
</form>
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="form mt-3" id="import-form">
    @csrf
    <input type="file" name="file" id="file-input" accept=".csv" style="display:none;" onchange="submitForm()">
</form>
 

