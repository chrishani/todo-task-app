<?php

namespace App\Repositories;

use App\Actions\Task\CreateTask;
use App\Actions\Task\GetRecentTasks;
use App\Actions\Task\MarkTaskAsDone;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function storeTask(array $data)
    {
        return CreateTask::run($data);
    }

    public function getRecentTasks(){
        return GetRecentTasks::run();
    }

    public function markAsDone(Task $task){
        return MarkTaskAsDone::run($task);
    }
}
