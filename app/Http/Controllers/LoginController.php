<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Events\UserCreated;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle = 'Login';
        return view('auth.login',compact("tittle"));
    }
    public function login(LoginRequest $request)
    {
        // Lấy dữ liệu đầu vào
        $credentials =[
            'email' => $request->input('email'), 
            'password' =>$request->input('password')
        ];
        $remember = $request->has('remember');
        if(Auth::attempt($credentials, $remember))
        {
            $user = Auth::user();
            $user->last_login_at = now();
            $user->last_login_ip = $request->ip();
            $user->updated_at = now();
            // nếu có nhấn remember
            if ($request->has('remember_token')) {
                $user->update(['remember_token' => Str::random(60)]);
            }
            $user->save();
            // Lưu thông tin vào session
            session(['user' => $user]);
            return redirect()->route('product.index');
        }
        else
        {
            // Đăng nhập thất bại
            return redirect()-> route('login')->withErrors([
            'error' => 'Email hoặc mật khẩu không chính xác.',
        ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

} 
