<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRecentTasks
{
    use AsAction;

    public function handle()
    {
        $query = Task::query()
            ->where('is_completed', '=', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5);
        return $query->get();
    }
}
