<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
    ) {}
    public function index()
    {
        return Inertia::render('ToDo/TodoList');
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskRepository->storeTask($request->all());
    }

    public function list()
    {
        return $this->taskRepository->getRecentTasks();
    }

    public function markAsDone(Task $task)
    {
        $this->taskRepository->markAsDone($task);
    }
}
