<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\ValidatorForm;
use App\Models\{Thread, User};
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    private $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $threads = Thread::orderBy('created_at', 'desc')->paginate(15);

        return Inertia::render('Threads/Index', [
            'threads' => $threads->items(),
            'pagination' => [
                'current_page' => $threads->currentPage(),
                'last_page' => $threads->lastPage(),
                'total' => $threads->total(),
            ],
            'flash' => session()->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Threads/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidatorForm $validatorForm)
    {
        $threadData = $validatorForm->validated();
    
        $user = User::find(1);
        $user->threads()->create($threadData);
    
        return redirect()->route('threads.index')
            ->with('flash', [
                'message' => 'Tópico criado com sucesso!',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $slug)
    {
        $thread = Thread::where('slug', $slug)
            ->with('replies.user')
            ->first();

        $user = $thread->user;

        return inertia::render('Threads/Show', [
            'thread' => $thread,
            'user' => $user,
            'replies' => $thread->replies,
        ]);
    }

    // public function show(string $slug)
    // {
    //     $thread = Thread::where('slug', $slug)->firstOrFail();
    //     $user = $thread->user;

    //     return Inertia::render('Threads/Show', [
    //         'thread' => $thread,
    //         'user' => $user
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $thread = Thread::where('slug', $slug)->firstOrFail();

        return Inertia::render('Threads/Edit', [
            'thread' => $thread
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidatorForm $validatorForm, Thread $thread)
    {
        $thread->update([
            'title' => $validatorForm->title,
            'body' => $validatorForm->body,
        ]);

        return redirect()->route('threads.index')
            ->with('flash', [
                'message' => 'Tópico atualizado!',
                'type' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $slug)
    // {
    //     $thread = Thread::where('slug', $slug)->first();

    //     // Verifique se o tópico existe
    //     if ($thread) {
    //         $thread->delete();
    //         return response()->json(['message' => 'Tópico excluído com sucesso!'], 200);
    //     }

    //     // Se não encontrar o tópico
    //     return response()->json(['error' => 'Erro ao tentar excluir o tópico. Tente novamente.'], 400);
    // }

    public function destroy(string $slug)
    {
        $thread = Thread::where('slug', $slug)->firstOrFail();

        $thread->delete();

        return redirect()->route('threads.index')
            ->with('flash', [
                'message' => 'Tópico excluído com sucesso!',
                'type' => 'danger',
            ]);
    }
}
