<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class MarkTaskAsDone
{
    use AsAction;

    public function handle(Task $task)
    {
        return $task->update(['is_completed' => true]);
    }
}
