@include('includes.header')
<body>
        <div class="container">
            <div class="header mt-1 row">
                <div class="col-lg-9 col-xs-12 menu">
                        <ul id="nav" class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" >Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('custormer.index') }}" class="nav-link active">Khách hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">User</a>
                            </li>
                        </ul>
                </div>
                <div class="col-lg-3 col-xs-12 admin pl-5">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p class="p">ADMIN</p>
                </div>
            </div>
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">Danh sách khách hàng</p>
                <a href="#" class="float-right col-2">Khách hàng</a>
            </div>
            <form class="row form mt-2 float-left" id="search-form">
                    <div class="col-lg-3 form-group search-name float-left">
                        <label for="customer_name">Họ và tên</label>
                        <input type="text" name="customer_name" id="customer_name" placeholder="Nhập họ tên" class="form-control">
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control">
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="is_active">Trạng thái</label>
                        <select name="is_active" id="is_active" class="form-control" style="width:200px;">
                            <option value="">Chọn trạng thái</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select> 
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" placeholder="Nhập địa chỉ" class="form-control">
                    </div>
                <div class="add-product col-lg-7 pl-0">
                        <div class="form-group float-left">
                            <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
                            <button type="submit" id="add" name="add" class="btn btn-primary"><a href="{{ route('custormer.create') }}" class="add-a">Thêm mới</a></button>
                        </div>
                        <div class="form-group float-left pl-5">
                            <i class="fa fa-upload import-csv" aria-hidden="true"></i>
                            <input type="file" name="import" id="import">
                            <label for="import" class="btn btn-success">Import CSV</label>
                        </div>
                        <div class="form-group float-left pl-5">
                            <i class="fa fa-download import-csv" aria-hidden="true"></i>
                            <button type="submit" id="export" name="export" class="btn btn-success">Export CSV</button>
                        </div>
                </div>
                <div class="float-right ml-5">
                        <button type="submit" class="btn btn-search btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
                </div>
                <div class="ml-5">  
                        <button type="submit" class="btn btn-search btn-success" id="clear-search"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
                </div>        
        </form>
        <div class="row text-center">
            <nav class="mt-2">
                <ul class="pagination" id="pagination1">
                    <!-- Phân trang sẽ được thêm vào đây -->
                </ul>
            </nav>
        </div>
            <div class="row mt-2">
                <table class="table table-striped">
                    <thead class="thead-danger">
                      <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th></th>
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
</body>

</html>
