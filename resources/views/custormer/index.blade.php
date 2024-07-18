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
            <div class="col-lg-7">
                @if($customer->total() > 20)
                    <div class="pt-3 pl-0 pagination" id="pagination1">
                        {{-- Phân trang --}}
                    </div>
                @endif
            </div>
            <p class="col-lg-5 pt-5 text-center float-right " style="font-size: 14px;" id="pagination-info"></p>
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
                @if ($customer->total()>20)
                    <div class="pagination" id="pagination2">
                        {{-- Phân trang --}}
                    </div> 
                @endif
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
        @include('custormer.modal')
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
