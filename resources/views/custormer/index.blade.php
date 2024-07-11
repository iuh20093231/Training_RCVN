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
            <nav class="col-lg-7 mt-2 p-0">
                <ul class="pagination" id="pagination1">
                    <!-- Phân trang sẽ được thêm vào đây -->
                </ul>
            </nav>
            <p class="col-lg-5 text-center pl-5 mt-2" style="font-size: 14px;">Hiển thị từ {{ $customer->firstItem() }} đến {{ $customer->lastItem() }} trong tổng số <strong>{{ $customer->total() }}</strong> khách hàng</p>
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
                <nav>
                    <ul class="pagination" id="pagination2">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
            </div> 
        </div>
        <script src="{{ asset('js/customer.js') }}"></script>
        <script>
           $(document).ready(function() {
                $('#import').change(function() {
                    var filename = $(this).val().split('\\').pop(); // Lấy tên file từ đường dẫn tập tin
                    $('#tenfile').val(filename); // Hiển thị tên file trong input
                });
            });
        </script>
</body>

</html>
