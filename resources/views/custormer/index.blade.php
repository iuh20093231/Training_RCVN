@include('includes.header')
<body>
        <div class="container">
        @include('custormer.navbar')
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">Danh sách khách hàng</p>
                <a href="#" class="float-right col-2">Khách hàng</a>
            </div>
        @include('custormer.search')       
        <div class="row">
            <div class="col-lg-7" id="pagination-wrapper">
                <div class="pt-3 pl-0 pagination" id="pagination1">
                    {{-- Phân trang --}}
                </div>
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
            <div class="row mt-2 text-center" id="pagination-wrapper2">
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
        <script>
            function submitForm() {
                document.getElementById('import-form').submit();
            }
        </script>
</body>

</html>
