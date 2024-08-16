<div class="header row">
    <div class="col-lg-10 menu ps-0">
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
    @include('includes.logout')
</div>