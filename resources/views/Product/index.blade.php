@include('includes.header')
<body>
    <div id=app>
        <div class="container">
            <div class="header mt-1 row">
                <div class="col-lg-9 col-xs-12 menu">
                        <ul id="nav" class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link active" >Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('custormer.index') }}" class="nav-link">Khách hàng</a>
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
                        <p class="float-left col-10 pl-0">Danh sách sản phẩm</p>
                        <a href="#" class="float-right col-2">Sản phẩm</a>
            </div>
                <form action="" method="POST" class="row form mt-2 float-left" >
                    {{ csrf_field() }}
                    <div class="col-lg-3 form-group search-name float-left">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" class="form-control">
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="name">Trạng thái</label>
                        <select name="status" id="status" class="form-control" style="width:200px;">
                            <option value="1">Đang bán</option>
                            <option value="2">Hết Hàng</option>
                            <option value="0">Ngừng bán</option>
                        </select>
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="start-price">Giá bán từ</label>
                        <input type="text" name="start-price" id="start-price" class="form-control"> 
                    </div>
                    <span class="col-lg-1 text-center"><i class="fa fa-minus float-left mt-5 ml-4" aria-hidden="true"></i></span>
                    <div class="col-lg-2 form-group search-name float-right">
                        <label for="end-price">Giá bán đến</label>
                        <input type="text" name="end-price" id="end-price" class="form-control"> 
                    </div>
                <div class="add-product pl-0">
                        <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
                        <button type="submit" id="add" name="add" class="btn btn-primary"><a href="#" class="add-a">Thêm mới</a></button>
                </div>
                <div class="float-right ml-5">
                        <button type="submit" class="btn btn-search btn-primary"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
                </div>
                <div class="float-right ml-5">
                        <button type="submit" class="btn btn-search btn-success"><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
                </div>
            </form>
            <div class="row text-center">
                <nav class="mt-2">
                    <ul class="pagination" id="pagination1">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
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
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="user-table">
                      <tr>
                        <td>1</td>
                        <td>Sản phẩm A</td>
                        <td>Chức năng sản phẩm A</td>
                        <td>$100</td>
                        <td>Đang bán</td>
                        <th>
                            <a href="#" class="update mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="#" class="delete mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </th>
                      </tr>
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

</body>

</html>
