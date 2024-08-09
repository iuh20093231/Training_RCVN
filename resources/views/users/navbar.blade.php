<div class="header mt-1 row">
    <div class="col-lg-9 col-xs-12 menu ps-0">
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
    <div class="col-lg-3 col-xs-12 admin float-end">
        <div class="dropdown">
            <i class="fa fa-user-circle-o dropdown-toggle" aria-hidden="true" data-bs-toggle="dropdown"></i>
            <ul class="dropdown-menu dropdown-menu-end mt-2">
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </div>
        <p class="float-start">ADMIN</p>
    </div>
</div>