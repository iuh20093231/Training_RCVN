<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $tittle = 'User';
        $users = User::popular();
        return view('users.index', compact('tittle','users'));

    }
    public function getUsers(Request $request)
    {
            $query = User::query();

            if ($request->filled('name')) {
                $query->nameLike($request->name);
            }

            if ($request->filled('email')) {
                $query->emailLike($request->email);
            }

            if ($request->filled('group_role')) {
                $query->groupRole($request->group_role);
            }

            if ($request->filled('is_active')) {
                $query->isActive($request->is_active);
            }

            $users = $query->notDeleted()->orderBy('created_at', 'desc')->paginate(20);
            return response()->json($users);
    }

    public function create()
    {
        $tittle = 'Add user';
        return view('users.add',compact("tittle"));
    }
     
    public function store(UserRequest $request)
    {
        $validator = $request->validated();
        if($request->has('is_active'))
        {
            $is_active = 1;
        }
        else
        {
            $is_active = 0;
        }
        User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
            'is_active' => $is_active,
            'group_role' => $request->group,
            'created_at' => now()
        ]);
        return redirect()->route('users.index')->with('success', 'Người dùng đã được tạo thành công.');
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
       return response()->json($user);
    }
    public function update(UpdateUserRequest $request,$id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $updateData = [
        'name' => $data['name'],
        'email' => $data['email'],
        'group_role' => $request->group_role,
        'is_active' => $request->is_active,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = bcrypt($data['password']);
        }

        $user->update($updateData);

        return response()->json(['success' => 'Chỉnh sửa người dùng thành công']);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->is_delete = 1;
            $user->email ='user'.$id.'@gmail.com';
            $user->save();   
        }
        return response()->json(['message' => 'Xóa người dùng thành công']);
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
