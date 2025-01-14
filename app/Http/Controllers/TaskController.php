<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tasks = Task::with('author')->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png|max:1024'
        ]);

        $userId = Auth::id();
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $userId,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $task->id . '-' . md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $uploadedFile = $file->storeAs(config('app.tasks_images_path'), $fileName);
            if ($uploadedFile) {
                Image::create(['file' => $fileName,'task_id' => $task->id]);
            }
        }

        return redirect('/tasks/' . $task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function show(Task $task)
    {
        $id = $task->id;
        $task = Cache::remember('task-' . $id, 60,
            function () use ($id) {
                return Task::find($id);
            });
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        if (Cache::has('task-' . $task->id)) {
            Cache::forget('task-' . $task->id);
        }

        $request->session()->flash('message', 'Úloha bola úspešne zmenená.');

        return redirect('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        if (Cache::has('task-' . $task->id)) {
            Cache::forget('task-' . $task->id);
        }

        $request->session()->flash('message', 'Úloha bola úspešne vymazaná.');
        return redirect('tasks');
    }
}
