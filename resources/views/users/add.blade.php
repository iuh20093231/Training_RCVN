<div class="modal fade" id="addUsers">
    <div class="modal-dialog modal-dialog-form">
      <div class="modal-content">
        <div class="modal-header">
            <div class="header-add p-1">
                <h3 class="text-center">Thêm user</h3>
           </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.create') }}" method="post" class="form form-add">
                {{ csrf_field() }}
                <div class="row form-group">
                    <label for="name" class="col-3 lbl">Tên</label>
                    <input type="text" name="name" id="name" class="col-8 form-control @error('name') is-invalid @enderror" placeholder="Nhập họ tên" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="email" class="col-3 lbl">Email</label>
                    <input type="text" name="email" id="email" class="col-8 form-control @error('email') is-invalid @enderror" placeholder="Nhập email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="password" class="col-3 lbl">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="col-8 form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="reset_password" class="col-3 lbl">Xác nhận</label>
                    <input type="password" name="reset_password" id="reset_password" class="col-8 form-control @error('reset_password') is-invalid @enderror" placeholder="Xác mật khẩu" value="{{ old('reset_password') }}" >
                    @error('reset_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="group" class="col-3 lbl">Chọn nhóm</label>
                    <select name="group" id="group" class="col-8 form-control">
                        <option value="Admin" {{ old('group_role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Reviewer" {{ old('group_role') == 'Reviewer' ? 'selected' : '' }}>Reviewer</option>
                        <option value="Editor" {{ old('group_role') == 'Editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                </div>
                <div class="row form-group ml-4 mt-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Trạng thái hoạt động</label>
                </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-gray mr-3" data-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-danger">Lưu</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
