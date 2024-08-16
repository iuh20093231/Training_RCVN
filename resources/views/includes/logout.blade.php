<div class="col-lg-2">
    <div class="dropdown">
        <div data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center dropdown-toggle" style="cursor: pointer;">
            <i class="fa fa-user-circle-o fa-2x me-2 mb-3"></i>
            <p class="p mb-0 float-start mt-2" style="line-height: 60px; font-weight: bold; color: #333;">ADMIN</p>
        </div>
        <ul class="dropdown-menu dropdown-menu-start mt-3 p-0 shadow border-0" id="nav-out">
            <li class="li-out">
                <form action="{{ route('logout') }}" method="post" class="dropdown-item text-center m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 py-2">Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>
</div>