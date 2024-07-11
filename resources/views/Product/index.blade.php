@include('includes.header')
<body>
    <div id=app>
        <div class="container">
            @include('Product.navbar')
            <div class="row tittle pt-2">
                        <p class="float-left col-10 pl-0">Danh sách sản phẩm</p>
                        <a href="#" class="float-right col-2">Sản phẩm</a>
            </div>
            @include('Product.search')
            <div class="row text-center">
                <nav class="col-lg-7 mt-2 p-0">
                    <ul class="pagination" id="pagination1">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
                <p class="col-lg-5 text-center pl-5 mt-2" style="font-size: 14px;">Hiển thị từ {{ $product->firstItem() }} đến {{ $product->lastItem() }} trong tổng số <strong>{{ $product->total() }}</strong> sản phẩm</p>
            </div>
            <div class="row">
                <table class="table table-striped mt-3">
                    <thead class="thead-danger">
                      <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Tình trạng</th>
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
    </div>
    <script src="{{ asset('js/product.js') }}"></script>
</body>

</html>
