<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnician;
use App\Services\SkillService;
use App\Services\TechnicianService;
use Inertia\Inertia;

class TechnicianController extends Controller
{
    public function __construct(
        protected TechnicianService $service
    ) {}
    public function create(
        SkillService $skillService
    ) {
        $skills = $skillService->get();
        return Inertia::render('technician/Create', [
            'skills' => $skills
        ]);
    }

    public function store(StoreTechnician $request)
    {
        $this->service->store($request->validated());
        return to_route('home')->with('success', 'Technician create success.');
    }
}
