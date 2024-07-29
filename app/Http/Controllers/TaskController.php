<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
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

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'name' => $request->name,
            'created_at' => $request->created_at ?: now()
        ]);

        return response()->json($task);
    }

    public function toggleCompletion($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();

        return response()->json([
        'completed' => $task->completed,
        ]);
        
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Xóa task thành công']);
    }
}
