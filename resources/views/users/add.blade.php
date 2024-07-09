@include('includes.header');
<body>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="add-user">
            <div class="header-add p-1">
                 <h3 class="text-center">Thêm user</h3>
            </div>
            <form action="{{ route('users.create') }}" method="post" class="form form-add">
                {{ csrf_field() }}
                <div class="row form-group">
                    <label for="name" class="col-3 lbl">Tên</label>
                    <input type="text" name="name" id="name" class="col-8 form-control" placeholder="Nhập họ tên">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="email" class="col-3 lbl">Email</label>
                    <input type="text" name="email" id="email" class="col-8 form-control" placeholder="Nhập email">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="password" class="col-3 lbl">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="col-8 form-control" placeholder="Mật khẩu">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="reset_password" class="col-3 lbl">Xác nhận</label>
                    <input type="password" name="reset_password" id="reset_password" class="col-8 form-control" placeholder="Xác mật khẩu">
                    @if ($errors->has('reset_password'))
                    <span class="text-danger">{{ $errors->first('reset_password') }}</span>
                    @endif
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
                <div class="row form-group float-right">
                    <button type="button" class="btn btn-gray mr-3"><a href="{{ route('users.index') }}" style="text-decoration: none;">Hủy</a></button>
                    <button type="submit" class="btn btn-danger">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>