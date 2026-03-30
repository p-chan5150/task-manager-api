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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /* $report = new ReportQuery(); */
        /* $queryItems = $report->transform($request); */
        /**/
        /* if (queryItems == 0) { */
        /*    $tasks = new TasksCollection(Tasks::all()); */
        /* } else { */
        /*     $tasks = new TasksCollection(Tasks::where($queryItems)); */
        /* } */
        /**/
        /* if ($tasks->isempty()) { */
        /*     return ['message' => 'No tasks found', 'data' => []]; */
        /* } */
        /**/
        /* return $tasks; */

        $tasks = Tasks::query()
            ->when($request->query('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->sorted()
            ->get();

        if ($tasks->isempty()) {
            return response()->json(['error' => 'Task not found in database'], 404);
        }

        return new TasksCollection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTasksRequest $request)
    {
        return new TasksResource(Tasks::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $task)
    {
        return new TasksResource($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(UpdateTaskStatusRequest $request, Tasks $task)
    {
        return new TasksResource(tap($task)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        if ($task->status->value !== 'done') {
            return response()->json([
                'error' => 'Only done tasks can be deleted'
            ], 403);
        }

        $task->delete();
        return response()->json(null, 204);
    }

    public function report(TaskReportRequest $request)
    {
        $date = $request->validated()['date'];

        $tasks = Tasks::whereDate('due_date', $date)->get();

        $summary = [
            'high'   => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'medium' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'low'    => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
        ];

        foreach ($tasks as $task) {
            $summary[$task->priority->value][$task->status->value]++;
        }

        return response()->json([
            'date'    => $date,
            'summary' => $summary
        ]);
    }
}
