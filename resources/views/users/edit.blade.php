@include('includes.header');
<body>
    <div class="container">
        <div class="add-user">
            <div class="header-add p-1">
                 <h3 class="text-center">Chỉnh sửa user</h3>
            </div>
            <form action="{{ route('users.update',$user->id) }}" method="POST" class="form form-add">
                @csrf
                @method('PUT')
                <div class="row form-group">
                    <label for="name" class="col-3 lbl">Tên</label>
                    <input type="text" name="name" id="name" class="col-8 form-control" placeholder="Nhập họ tên" value="{{ $user->name }}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="email" class="col-3 lbl">Email</label>
                    <input type="text" name="email" id="email" class="col-8 form-control" placeholder="Nhập email" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="password" class="col-3 lbl">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="col-8 form-control" placeholder="Mật khẩu" >
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
                    <label for="group_role" class="col-3 lbl">Chọn nhóm</label>
                    <select name="group_role" id="group_role" class="col-8 form-control">
                        <option value="Admin" {{ $user->group_role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Reviewer" {{ $user->group_role == 'Reviewer' ? 'selected' : '' }}>Reviewer</option>
                        <option value="Editor" {{ $user->group_role == 'Editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label for="is_active" class="col-3 lbl">Trạng thái</label>
                    <input type="checkbox" name="is_active" id="is_active" {{ $user->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Trạng thái hoạt động</label>
                </div>
                <div class="row form-group float-right">
                    <button type="submit" class="btn btn-gray mr-3"><a href="{{ route('users.index') }}" style="text-decoration: none;">Hủy</a></button>
                    <button type="submit" class="btn btn-danger">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>