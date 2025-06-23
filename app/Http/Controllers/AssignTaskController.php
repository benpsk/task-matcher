<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;

class AssignTaskController extends Controller
{
    public function __invoke(
        TaskService $service,
        Request $request,
    ) {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);
        try {
            $message = $service->assign($validated);
            return to_route('home')->with('success', $message);  // Success message
        } catch (Exception $e) {
            return to_route('home')->with('error', $e->getMessage());
        }
    }
}
