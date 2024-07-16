@include('includes.header')
<body>
        <div class="container">
        @include('custormer.navbar')
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">Danh sách khách hàng</p>
                <a href="#" class="float-right col-2">Khách hàng</a>
            </div>
        @include('custormer.search')
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="form mt-3">
            @csrf
            <label for="file"><i class="fa fa-upload import-csv" aria-hidden="true"></i></label>
            <input type="file" name="file" id="file" accept=".csv" style="display:none;">
            <button  class="btn btn-success" type="submit">Import CSV</button>
            <input type="text" name="tenfile" id="tenfile" readonly style="border: 1px solid white; width: auto;">
        </form>        
        <div class="row">
            <div class="col-lg-7 pt-3 pl-0 pagination" id="pagination1">
                {{-- Phân trang --}}
            </div>
            <p class="col-lg-5 text-center pt-5" style="font-size: 14px;">Hiển thị từ {{ $customer->firstItem() }} đến {{ $customer->lastItem() }} trong tổng số <strong>{{ $customer->total() }}</strong> khách hàng</p>
        </div>
         <div class="row mt-1">
                <table class="table table-striped">
                    <thead class="thead-danger">
                      <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="user-table">
                    </tbody>
                  </table>
        </div> 
            <div class="row mt-2 text-center">
                <div class="pagination" id="pagination2">
                    {{-- Phân trang --}}
                </div>
            </div> 
        </div>
        @if (session('import_failures'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('import_failures') as $failure)
                            <li>Dòng {{ $failure['row'] }}: {{ implode(', ', $failure['errors']) }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
        {{-- Popup add customer --}}
        @include('custormer.add')
        {{-- Modal xóa khách hàng --}}
        <div class='modal fade' id='myModal' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content min-h-65'>
                    <div class='modal-body text-center'>
                        <div class='icon-status mt-2 p-5'>     
                            <i class="fa fa-exclamation-triangle text-warning " aria-hidden="true" style="font-size: 70px;"></i>
                            <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                            <p class="p">Bạn có chắc muốn xóa khách hàng <span id="customer-name"></span> <span id="customer-id" style="display: none;"></span> này không?</p>
                        </div>
                            <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy'>
                            <input type='button' class='btn btn-danger mb-3' id="btn-delete" value='Okay'>
                        </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/customer.js') }}"></script>
        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var addCustomerModal = new bootstrap.Modal(document.getElementById('addCustomer'));
                    addCustomerModal.show();
                });
            </script>
        @endif
</body>

</html>
