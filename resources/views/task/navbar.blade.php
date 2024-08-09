<div class="header row">
    <div class="col-lg-9 col-xs-12 menu ps-0">
            <ul id="nav" class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link" >Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('custormer.index') }}" class="nav-link ">Khách hàng</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">User</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task') }}" class="nav-link active">Task</a>
                </li>
            </ul>
    </div>
    <div class="col-lg-3 col-xs-12 admin float-right">
        <div class="dropdown">
                <i class="fa fa-user-circle-o" aria-hidden="true" data-bs-toggle="dropdown" class="dropdown-toggle"></i>
            <div class="dropdown-menu mt-2">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <input type="submit" name="btn" class="btn btn-block btn-logout" value="Đăng xuất">
                </form>
            </div>
        </div>
        <p class="p float-left">ADMIN</p>
    </div>
</div>