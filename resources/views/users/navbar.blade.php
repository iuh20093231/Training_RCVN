<div class="header mt-1 row">
    <div class="col-lg-10 menu ps-0">
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
                <li class="nav-item">
                    <a href="{{ route('task') }}" class="nav-link">Task</a>
                </li>
            </ul>
    </div>
    <div class="col-lg-2">
        <div class="dropdown">
            <div data-bs-toggle="dropdown">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <p class="p float-start" style="line-height: 70px;">ADMIN</p>
            </div>
            <ul class="dropdown-menu dropdown-menu-start mt-5 p-0" id="nav-out">
                <li class="li-out">
                    <form action="{{ route('logout') }}" method="post" class="dropdown-item p-0 text-center">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-block">Đăng xuất</button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>