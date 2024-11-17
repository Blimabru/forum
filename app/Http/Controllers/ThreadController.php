<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Inertia\Inertia;

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
        $threads = Thread::all();

        return Inertia::render('Threads/Index', [
            'threads' => $threads
        ]);

        //$threads = $this->thread->paginate(15);
        //return view('thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Threads/Create');

        //return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Criar novo thread
        Thread::create($request->only('title', 'body'));

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->route('threads.index')
                         ->with('success', 'Thread criado com sucesso!');

        // try {
        //     $this->thread->create($request->all());

        //     dd('Tópico criado com sucesso!');
        // } catch (\Exception $e) {

        //     dd($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread /*string $id*/)
    {
        return Inertia::render('Threads/Show', [
            'thread' => $thread
        ]);

        //return redirect()->route('threads.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread /*string $id*/)
    {
        return Inertia::render('Threads/Edit', [
            'thread' => $thread
        ]);

        //$this->thread->find($id);
        //return view('thread.edit', compact('threads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread /*string $id*/)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Atualizar o thread
        $thread->update($request->only('title', 'body'));

        return redirect()->route('threads.index')
                         ->with('success', 'Thread atualizado com sucesso!');

        // try {
        //     $thread = $this->thread->find($id);
        //     $thread->update($request->all());

        //     dd('Tópico atualizado com sucesso!');
        // } catch (\Exception $e) {

        //     dd($e->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread /*string $id*/)
    {
        // Deletar o thread
        $thread->delete();

        return redirect()->route('threads.index')
                         ->with('success', 'Thread excluído com sucesso!');
    
        // try {
        //     $thread = $this->thread->find($id);
        //     $thread->delete();

        //     dd('Tópico removido com sucesso!');
        // } catch (\Exception $e) {

        //     dd($e->getMessage());
        // }
    }
}
