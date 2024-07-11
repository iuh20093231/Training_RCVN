@include('includes.header');
<body>
    <div class="container">
        <div class="add-user">
            <div class="header-add p-1">
                 <h3 class="text-center">Thêm khách hàng</h3>
            </div>
            <form action="{{ route('custormer.create') }}" method="post" class="form form-add">
                {{ csrf_field() }}
                <div class="row form-group">
                    <label for="customer_nameame" class="col-3 lbl">Tên</label>
                    <input type="text" name="customer_name" id="customer_name" class="col-8 form-control" placeholder="Nhập họ tên">
                    @if ($errors->has('customer_name'))
                    <span class="text-danger">{{ $errors->first('customer_name') }}</span>
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
                    <label for="tel_num" class="col-3 lbl">Điện thoại</label>
                    <input type="text" name="tel_num" id="tel_num" class="col-8 form-control" placeholder="Điện thoại">
                    @if ($errors->has('tel_num'))
                    <span class="text-danger">{{ $errors->first('tel_num') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="address" class="col-3 lbl">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="col-8 form-control" placeholder="Địa chỉ">
                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label for="is_active" class="col-3 lbl">Trạng thái</label>
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Trạng thái hoạt động</label>
                </div>
                <div class="row form-group float-right">
                    <button type="submit" class="btn btn-gray mr-3"><a href="{{ route('custormer.index') }}" style="text-decoration: none;">Hủy</a></button>
                    <button type="submit" class="btn btn-danger">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>