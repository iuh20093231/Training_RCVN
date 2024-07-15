
<div class="modal fade" id="addCustomer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <div class="header-add p-1">
                <h3 class="text-center">Thêm khách hàng</h3>
            </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('custormer.create') }}" method="post" class="form form-add" id="addCustomerForm">
                {{ csrf_field() }}
                <div class="row form-group">
                    <label for="customer_nameame" class="col-3 lbl">Tên</label>
                    <input type="text" name="customer_name" id="customer_name" class="col-8 form-control @error('customer_name') is-invalid @enderror" placeholder="Nhập họ tên" value="{{ old('customer_name') }}">
                    @error('customer_name')
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
                    <label for="tel_num" class="col-3 lbl">Điện thoại</label>
                    <input type="text" name="tel_num" id="tel_num" class="col-8 form-control @error('tel_num') is-invalid @enderror" placeholder="Điện thoại" value="{{ old('tel_num') }}">
                    @error('tel_num')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="address" class="col-3 lbl">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="col-8 form-control @error('address') is-invalid @enderror" placeholder="Địa chỉ" value="{{ old('address') }}">
                    @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
                <div class="row form-group">
                    <label for="is_active" class="col-3 lbl">Trạng thái</label>
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Trạng thái hoạt động</label>
                </div>
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