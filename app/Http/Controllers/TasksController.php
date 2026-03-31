<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTasksRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Resources\TasksResource;
use App\Http\Resources\TasksCollection;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Requests\TaskReportRequest;

class TasksController extends Controller
{
    /**
     * Display a all tasks in sortedby priority and due date
     */
    public function index(Request $request)
    {

        // Optional status query
        $tasks = Tasks::query()
            ->when($request->query('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            // scope sort specified on tasks model
            ->sorted()
            ->get();

        // Resposne if no tasks exist
        if ($tasks->isempty()) {
            return response()->json(['error' => 'Task not found in database'], 404);
        }

        return new TasksCollection($tasks);
    }

    /**
     * Store a newly created tasks
     */
    public function store(StoreTasksRequest $request)
    {
        return new TasksResource(Tasks::create($request->all()));
    }

    /**
     * Display a specified task
     */
    public function show(Tasks $task)
    {
        return new TasksResource($task);
    }

    /**
     * Update task status
     */
    public function updateStatus(UpdateTaskStatusRequest $request, Tasks $task)
    {
        return new TasksResource(tap($task)->update($request->all()));
    }

    /**
     * Remove a specified task
     */
    public function destroy(Tasks $task)
    {
        // Vadidates if task is done before deletion
        if ($task->status->value !== 'done') {
            return response()->json([
                'error' => 'Only done tasks can be deleted'
            ], 403);
        }

        $task->delete();
        return response()->json(null, 204);
    }

    /**
     * Return counts per priority and status for a given
     * Date query handled on task report request
     */
    public function report(TaskReportRequest $request)
    {
        $date = $request->validated()['date'];

        $tasks = Tasks::whereDate('due_date', $date)->get();

        // Initialize summary
        $summary = [
            'high'   => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'medium' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'low'    => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
        ];

        // Iterate for each count
        foreach ($tasks as $task) {
            $summary[$task->priority->value][$task->status->value]++;
        }

        return response()->json([
            'date'    => $date,
            'summary' => $summary
        ]);
    }
}
