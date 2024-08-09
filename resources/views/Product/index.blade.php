@include('includes.header')
<body>
    <div id=app>
        <div class="container">
            @include('Product.navbar')
            <div class="row tittle pt-2">
                        <p class="float-left col-10 pl-0">Danh sách sản phẩm</p>
                        <a href="#" class="float-right col-2">Sản phẩm</a>
            </div>
            <task-product></task-product>
        </div>
    </div>
</body>

</html>
