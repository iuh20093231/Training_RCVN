@include('includes.header')
<body>
<div id="app">
    <div class="container">
        @include('users.navbar')
            <div class="row tittle pt-2">
                <p class="float-left col-10 pl-0">User</p>
            </div>
            <task-user></task-user>
    </div>
</div>
</body>
</html>
