
<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-form">
      <div class="modal-content">
        <div class="modal-header">
            <div class="header-add p-1">
                <h3 class="text-center">Chỉnh sửa user</h3>
           </div>
        </div>
        <div class="modal-body">
            <form  class="form form-add" id="editUserForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="user_id"> 
                <div class="row form-group">
                    <label for="name" class="col-3 lbl">Tên</label>
                    <input type="text" name="name" id="edit_name" class="col-8 form-control" placeholder="Nhập họ tên">
                </div>
                <div class="row form-group">
                    <label for="email" class="col-3 lbl">Email</label>
                    <input type="text" name="email" id="edit_email" class="col-8 form-control" placeholder="Nhập email">
                
                </div>
                <div class="row form-group">
                    <label for="password" class="col-3 lbl">Mật khẩu</label>
                    <input type="password" name="password" id="edit_password" class="col-8 form-control" placeholder="Mật khẩu">
                   
                </div>
                <div class="row form-group">
                    <label for="reset_password" class="col-3 lbl">Xác nhận</label>
                    <input type="password" name="reset_password" id="edit_reset_password" class="col-8 form-control" placeholder="Xác mật khẩu">
                 
                </div>
                <div class="row form-group">
                    <label for="group" class="col-3 lbl">Chọn nhóm</label>
                    <select name="group_role" id="edit_group" class="col-8 form-control">
                        <option value="Admin" >Admin</option>
                        <option value="Reviewer">Reviewer</option>
                        <option value="Editor">Editor</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label for="is_active" class="col-3 lbl">Trạng thái</label>
                    <input type="checkbox" name="is_active" id="edit_is_active">
                    <label class="form-check-label" for="is_active">Trạng thái hoạt động</label>
                </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-gray mr-3" data-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-danger" id="btn-update">Lưu</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
