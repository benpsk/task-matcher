<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreTask;
use App\Services\SkillService;
use App\Services\TaskService;
use GuzzleHttp\Handler\Proxy;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $service
    ) {}
    public function create(
        SkillService $skillService
    ) {
        $skills = $skillService->get();
        return Inertia::render('task/Create', [
            'skills' => $skills
        ]);
    }

    public function store(StoreTask $request)
    {
        $this->service->store($request->validated());
        return to_route('home')->with('success', 'Task create success.');
    }
}
