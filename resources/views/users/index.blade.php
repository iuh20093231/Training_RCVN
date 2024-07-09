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
                                <a href="{{ route('custormer.index') }}" class="nav-link ">Khách hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link active">User</a>
                            </li>
                        </ul>
                </div>
                <div class="col-lg-3 col-xs-12 admin pl-5">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <p class="p">ADMIN</p>
                </div>
            </div>
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">User</p>
            </div>
            <form class=" row form mt-2 float-left" id="search-form">
                    <div class="col-lg-3 form-group search-name float-left">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" placeholder="Nhập họ tên" class="form-control">
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control">
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="group_role">Nhóm</label>
                        <select name="group_role" id="group_role" class="form-control" style="width:200px;">
                            <option value="">Chọn nhóm</option>
                            <option value="Reviewer">Reviewer</option>
                            <option value="Admin">Admin</option>
                            <option value="Editor">Editor</option>
                        </select> 
                    </div>
                    <div class="col-lg-3 form-group search-name float-left pl-5">
                        <label for="is_active">Trạng thái</label>
                        <select name="is_active" id="is_active" class="form-control" style="width:200px;">
                            <option value="">Chọn trạng thái</option>
                            <option value="0">Không hoạt động</option>
                            <option value="1">Đang hoạt động</option>
                            <option value="2">Tạm khóa</option>
                        </select> 
                    </div>
                <div class="add-product pl-0">
                        <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
                        <button type="submit" id="add" name="add" class="btn btn-primary"><a href="{{ route('users.create') }}" class="add-a">Thêm mới</a></button>  
                </div>
                <div class="ml-5">
                        <button type="submit" class="btn btn-search btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"> Tìm kiếm</i></button>
                </div>
                <div class="ml-5">
                        <button type="submit" class="btn btn-search btn-success" id="clear-search" ><i class="fa fa-times" aria-hidden="true">  Xóa tìm</i></button>
                </div>
            </form>
            <div class="row text-center">
                <nav class="mt-2">
                    <ul class="pagination" id="pagination1">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
            </div>
            <div class="row mt-2" id="users-table">
                <table class="table table-striped">
                    <thead class="thead-danger">
                      <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Nhóm</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="user-table">
                        {{-- Hiển thị danh sách người dùng --}}
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
    {{-- Modal Xóa thành viên --}}
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Xác nhận xóa</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa user này không?
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
            {{-- <form action="{{ route('users.destroy',$user) }}" method="POST">
                @csrf
                @method('DELETE') --}}
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger" id="confirmDeleteBtn">Xóa</button>
            {{-- </form> --}}
            </div>
      
          </div>
        </div>
      </div>   
    <script src="{{ asset('js/user.js') }}"></script>
    
</body>

</html>
