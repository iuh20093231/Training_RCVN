@include('includes.header')
<body>
    
    <div class="container">
        @include('users.navbar')
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">User</p>
            </div>
            @include('users.search')
            <div class="row">
                <div class="col-lg-7" id="pagination-wrapper">
                    <div class="pt-3 pl-0 pagination" id="pagination1">
                        {{-- Phân trang --}}
                    </div>
                </div>
                <p class="col-lg-5 pt-5 text-center float-right " style="font-size: 14px;" id="pagination-info"></p>
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
            <div class="row mt-2 text-center" id="pagination-wrapper2">
                <div class="pagination" id="pagination2">
                    {{-- Phân trang --}}
                </div>
            </div>
    </div>
    {{-- Popup addUsers --}}
    @include('users.add')
    {{-- Popup updateUser --}}
    @include('users.edit')
    @include('users.modal')
    <script src="{{ asset('js/user.js') }}"></script>
    @if ($errors->any())
    <script src="{{ asset('js/modal.js') }}"></script>
    @endif
    <script src="{{ asset('js/password.js') }}"></script>
</body>

</html>
