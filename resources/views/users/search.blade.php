<form class=" row form mt-2 float-left" id="search-form">
    <div class="col-lg-3 form-group search-name float-left">
        <label for="name">Tên</label>
        <input type="text" name="name" id="name" placeholder="Nhập họ tên" class="form-control">
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control">
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="group_role">Nhóm</label>
        <select name="group_role" id="group_role" class="form-control custom-select" style="width:200px;">
            <option value="">Chọn nhóm</option>
            <option value="Reviewer">Reviewer</option>
            <option value="Admin">Admin</option>
            <option value="Editor">Editor</option>
        </select> 
    </div>
    <div class="col-lg-3 form-group search-name float-left pl-5">
        <label for="is_active">Trạng thái</label>
        <select name="is_active" id="is_active" class="form-control custom-select" style="width:200px;">
            <option value="">Chọn trạng thái</option>
            <option value="1">Đang hoạt động</option>
            <option value="0">Tạm khóa</option>
        </select> 
    </div>
<div class="add-product pl-0">
        <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
        <button type="button" id="add" name="add" class="btn btn-primary" data-toggle="modal" data-target="#addUsers">Thêm mới</button>  
</div>
<div class="ml-5">
    <button type="sumit" class="btn btn-search btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
</div>
<div class="ml-5">
        <button type="button" class="btn btn-search btn-success" id="clear-search" ><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
</div>
</form>