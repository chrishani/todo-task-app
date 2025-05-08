<?php

namespace App\Interfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function storeTask(array $data);

    public function getRecentTasks();

    public function markAsDone(Task $task);
}
