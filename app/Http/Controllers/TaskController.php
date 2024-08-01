<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::orderBy('order','asc')->orderBy('created_at','desc')->paginate(10);
        return response()->json($tasks);    
    }
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'created_at' => $request->date ?: now(),
        ]);

        return response()->json($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if($request->has('completed'))
        {
            $task->completed = !$task->completed;
        }
        $task->name = $request->name;
        $task->created_at = $request->created_at ?: now()->toDateString();
        $task->save();
        return response()->json($task);
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Xóa task thành công']);
    }
    public function updateOrder(Request $request)
    {
        $tasks = $request->input('tasks.data');
        if(is_array($tasks)){
            foreach ($tasks as $index => $task) {
                Task::where('id', $task['id'])->update(['order' => $index]);
            }
        } else {
            return response()->json(['lỗi' => 'Không hợp lệ'], 400);
        }
    }
}
