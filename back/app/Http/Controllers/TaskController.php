<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Deve retornar todas as tarefas
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    /**
     * Deve criar uma nova tarefa
     */

    public function store(Request $request)

    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
        ]);

        return response()->json($task);
    }

    /**
     * Deve retornar uma tarefa específica
     */

    public function show($id)

    {
        $task = Task::find($id);

        return response()->json($task);
    }

    /**
     * Deve atualizar uma tarefa específica
     */

    public function update(Request $request, $id)

    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $task = Task::find($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;

        $task->save();

        return response()->json($task);
    }

    /**
     * Deve deletar uma tarefa específica
     */

    public function destroy($id)

    {
        $task = Task::find($id);

        $task->delete();

        return response()->json($task);
    }
}
