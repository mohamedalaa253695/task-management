<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListTasksRequest $request)
    {
        $validated = $request->validated();

        $pageNumber = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $tasks = Task::with(['user', 'admin'])->paginate($perPage, ['*'], 'page', $pageNumber);

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $admins = User::where('is_admin', true)->get();
        $users = User::where('is_admin', false)->get();

        return view('task.create', compact('admins', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'admin_id' => $request->input('admin_id')
        ]);
        return redirect()->route('tasks', ['page' => 2])->with('success', 'Task created successfully!');
    }




    public function statistics()
    {

        $statistics = DB::table('tasks')
            ->select('user_id', DB::raw('count(*) as task_count'))
            ->groupBy('user_id')
            ->orderByDesc('task_count')
            ->take(10)
            ->get();

        $users = User::whereIn('id', $statistics->pluck('user_id'))->get();

        return view('task.statistics', compact('statistics', 'users'));
    }
}
