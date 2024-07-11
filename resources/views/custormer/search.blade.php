<form class="row form  float-left" id="search-form" >
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
        <select name="is_active" id="is_active" class="form-control" style="width:200px;">
            <option value="">Chọn trạng thái</option>
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select> 
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="address">Địa chỉ</label>
        <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="form-control">
    </div>
<div class="add-product col-lg-9 pl-0">
        <div class="form-group float-left">
            <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
            <button type="submit" id="add" name="add" class="btn btn-primary"><a href="{{ route('custormer.create') }}" class="add-a">Thêm mới</a></button>
        </div>
        <form action="{{ route('custormer.import') }}" method="POST" enctype="multipart/form-data" class="float-left">
            @csrf
            <div class="form-group float-left pl-2">
                    <label for="import"><i class="fa fa-upload import-csv" aria-hidden="true"></i></label>
                    <input type="file" name="import" id="import" accept=".csv">
                    <button type="submit" class="btn btn-success" id="submitBtn" name="btn">Import CSV</button>
                    <input type="text" name="tenfile" id="tenfile" readonly style="border: 1px solid white; width: auto;">
                    <i class="fa fa-download import-csv" aria-hidden="true"></i>
                    <a href="{{ route('custormer.export') }}" class="btn btn-success">Export CSV</a>
            </div>
            <button type="button" class="btn btn-search btn-primary ml-5" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
            <button type="button" class="btn btn-search btn-success ml-1" id="clear-search"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
        </form>
</div>
</form>