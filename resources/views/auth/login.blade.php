<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/brands.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/svg-with-js.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/v4-shims.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div id=app>
        <div class="container">
            <div class="p-5 form-login mt-5">
                <b>
                    <h1 class="text-center h1">ĐĂNG NHẬP</h1>
                </b>
                <form class="form mt-3" method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class=" frm-top user">
                        <label for="email" class="label mr-3"><i class="fa fa-user" aria-hidden="true"></i></label>
                        <input type="text" name="email" id="email"  placeholder="Email"><br>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif

                    </div>
                    <div class=" frm-top pass mt-2">
                        <label for="password" class="label mr-3"><i class="fa fa-lock" aria-hidden="true"></i></label>
                        <input type="password" name="password" id="password" v-model="password" placeholder="Mật khẩu"><br>
                        @if ($errors->has('password'))
                            <span class="text-danger" >{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form group mt-2 ml-2">
                        <input type="checkbox" id="remember_token" v-model="remember">
                        <label for="remember_token" class="pl-3">Remmber</label>
                    </div>
                    <div class="form-group mt-3 text-right">
                        <input type="submit" class="btn btn-login" id="txtDN" name="txtDN" value="Đăng nhập">
                    </div>
                </form>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</body>

</html>
