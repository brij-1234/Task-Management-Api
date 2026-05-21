<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    { 
        try{ 
            $query = Task::where('user_id', auth()->id());  
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            $tasks = $query->latest()->paginate(2);

            return ApiResponse::success('Tasks list', $tasks);
        } catch (\Exception $e){
            return ApiResponse::error('Failed to retrieve tasks', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) : JsonResponse
    {
        try{
            Task::create([
                ...$request->validated(),
                'user_id' => auth()->id()
            ]);

            return ApiResponse::success('Task created successfully', null, 201);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create task', $e->getMessage(), 500);
        }
    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id) : JsonResponse
    {  
        try{
            $task = Task::find($id);
            if(!$task) {
                return ApiResponse::error('Task not found', null, 404);
            }

            if ($task->user_id !== auth()->id()) {
                return ApiResponse::error('Unauthorized action', null, 403);
            }

            $task->update($request->validated());
            $task->refresh();
            return ApiResponse::success('Task updated successfully', $task);
            } catch (\Exception $e){
                return ApiResponse::error('Failed to update task', $e->getMessage(), 500);
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        try{
            $task = Task::find($id);
            if (!$task) {
                return ApiResponse::error('Task not found', null, 404);
            }
            if ($task->user_id !== auth()->id()) {
                return ApiResponse::error('Unauthorized action', null, 403);
            }
            $task->delete();

            return ApiResponse::success('Task deleted successfully', null);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to delete task', $e->getMessage(), 500);
        }
    }
}
