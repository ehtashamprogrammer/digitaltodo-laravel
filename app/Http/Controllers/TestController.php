<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $expired_tasks =  Task::where('due_date','>', \Carbon\Carbon::now())
            ->where('notified', false)
            ->orderBy('created_at', 'asc')->get();
        $expired_tasks_id = $expired_tasks->pluck('id');
        return $expired_tasks_id;
    }
}
