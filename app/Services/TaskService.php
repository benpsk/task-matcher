<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Technician;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function store(array $input)
    {
        Task::create($input);
    }

    public function assign(array $validated): string
    {
        // Fetch the task based on task_id
        $task = Task::findOrFail($validated['task_id']);

        // Fetch technicians with the required skill (Technicians who have this skill)
        $technicians = Technician::whereHas('skills', function ($query) use ($task) {
            $query->where('skills.id', $task->required_skill_id);  // Match required skill ID
        })->get();

        // Check if enough technicians are available for the task
        $availableTechnicians = $technicians->take($task->required_technicians);

        if ($availableTechnicians->count() < $task->required_technicians) {
            throw new Exception('no matching technician');
        }

        // Generate an array of days for the task (1 to duration)
        $assignedDays = range(1, $task->duration); // E.g., [1, 2, 3] for a 3-day task

        // Create assignment records in the `assign_task` pivot table
        $assignments = [];

        foreach ($availableTechnicians as $technician) {
            // Check if the technician is already assigned to this task
            $existingAssignment = DB::table('assign_tasks')
                ->where('task_id', $task->id)
                ->where('technician_id', $technician->id)
                ->exists();

            // Skip the technician if already assigned
            if ($existingAssignment) {
            throw new Exception('already assigned');
            }

            // Add the new assignment if not already assigned
            $assignments[] = [
                'task_id' => $task->id,
                'technician_id' => $technician->id,
                'assigned_days' => json_encode($assignedDays),  // Store assigned days as JSON
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // If there are any new assignments, insert them into the pivot table `assign_task`
        if (count($assignments) > 0) {
            DB::table('assign_tasks')->insert($assignments);
        }

        return "success";
    }
}
