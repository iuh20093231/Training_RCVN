@include('includes.header')
<body>
    <div id="app">
        <div class="container">
        @include('custormer.navbar')
        <div class="row tittle pt-2">
            <p class="float-left col-10 pl-0">Danh sách khách hàng</p>
            <a href="#" class="float-right col-2">Khách hàng</a>
        </div>
        <task-customer></task-customer>
        </div> 
    </div>
        {{-- @if (session('import_failures'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('import_failures') as $failure)
                            <li>Dòng {{ $failure['row'] }}: {{ implode(', ', $failure['errors']) }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif --}}
        {{-- Popup add customer --}}
        {{-- @include('custormer.add') --}}
        {{-- Modal xóa khách hàng --}}
        {{-- @include('custormer.modal') --}}
</body>

</html>
