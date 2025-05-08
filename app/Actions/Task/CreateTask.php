<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTask
{
    use AsAction;

    public function handle(array $data): Task
    {
        return Task::create($data);
    }
}
