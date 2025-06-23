<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $tasks = Task::with('skill', 'assign_tasks.technician')->take(10)->get();
        return Inertia::render('Welcome', [
            'tasks' => $tasks
        ]);
    }
}
