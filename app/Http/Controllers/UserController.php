<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle = 'User';
        $query = User::query();
        //return view('users.index',compact("tittle"));
        $users = $query->where('is_delete',0)->orderBy('created_at', 'desc')->paginate(20);
        return view('users.index', compact('tittle','users'));

    }
    // Lấy dữ liệu json của người dùng
    public function getUsers(Request $request)
    {
        try {
            $query = User::query();

            if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->filled('group_role')) {
                $query->where('group_role', $request->group_role);
            }

            if ($request->filled('is_active')) {
                $query->where('is_active', $request->is_active);
            }

            $users = $query->where('is_delete',0)->orderBy('created_at', 'desc')->paginate(20);
            return response()->json($users);

        } catch (\Exception $e) {
            \Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    // Thêm user
    public function create()
    {
        $tittle = 'Add user';
        return view('users.add',compact("tittle"));
    }
     
    public function store(UserRequest $request)
    {
        if($request->has('is_active'))
        {
            $is_active = 1;
        }
        else
        {
            $is_active = 0;
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $is_active,
            'group_role' => $request->group,
            'created_at' => now()
        ]);
        return redirect()->route('users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function show(User $user)
    {
       // return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tittle = 'Update User';
        $user = User::findOrFail($id);
        return view('users.edit',compact('tittle','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);
        if($request->has('is_active'))
        {
            $is_active = 1;
        }
        else
        {
            $is_active = 0;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'group_role' => $request->group_role,
            'is_active' => $is_active,
        ]);
        return redirect()->route('users.index')->with('success', 'Thông tin người dùng đã được cập nhật thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->is_delete = 1;
        $user->save();

        return response()->json(['message' => 'User deleted successfully']);
    }
    public function updateStatus($id)
    {
        $user = User::find($id);

        if ($user->is_active == 1) {
            $user->update(['is_active' => 0]);
        } else {
            $user->update(['is_active' => 1]);
        }
        return response()->json(['message' => 'Thành viên đã được khóa/mở khóa thành công!']);
    }
}
