@include('includes.header')
<body>
    
    <div class="container">
        @include('users.navbar')
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">User</p>
            </div>
            @include('users.search')
            <div class="row">
                <nav class="col-lg-7 mt-2 p-0">
                    <ul class="pagination" id="pagination1">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
                <p class="col-lg-5 pl-5 text-center mt-2" style="font-size: 14px;">Hiển thị từ {{ $users->firstItem() }} đến {{ $users->lastItem() }} trong tổng số <strong>{{ $users->total() }}</strong> người dùng</p>
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
                <nav >
                    <ul class="pagination" id="pagination2">
                        <!-- Phân trang sẽ được thêm vào đây -->
                    </ul>
                </nav>
            </div>
    </div>
    {{-- Modal Xóa thành viên --}}
    <div class='modal fade' id='myModal' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content min-h-65'>
                <div class='modal-body text-center'>
                    <div class='icon-status mt-2 p-5'>     
                        <i class="fa fa-exclamation-triangle text-warning " aria-hidden="true" style="font-size: 70px;"></i>
                        <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                        <p class="p">Bạn có chắc muốn xóa người dùng <span id="user-name-to-delete"></span><span id="user-id-to-delete" style="display: none;"></span> này không?</p>
                    </div>
                        <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy'>
                        <input type='button' class='btn btn-danger mb-3' id="btn-delete" value='Okay'>
                    </div>
             </div>
        </div>
    </div>
    {{-- Modal khóa người dùng --}}
    <div class='modal fade' id='lockUser' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content min-h-65'>
                <div class='modal-body text-center'>
                    <div class='icon-status mt-2 p-5'>     
                        <i class="fa fa-lock text-warning" aria-hidden="true" style="font-size: 70px;"></i>
                        <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                        <p class="p">Bạn có chắc muốn khóa/mở khóa người dùng <span id="user-name-to-lock"></span><span id="user-id-to-lock" style="display: none;"></span><span id="status" style="display: none;"></span>  này không?</p>
                    </div>
                        <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy'>
                        <input type='button' class='btn btn-danger mb-3' id="btn-lock" value='Okay'>
                    </div>
             </div>
        </div>
    </div>
    <script src="{{ asset('js/user.js') }}"></script>
</body>

</html>
