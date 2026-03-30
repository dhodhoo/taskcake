<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $search = $request->input('search');

        $notes = $user->notes()
            ->when($search, function ($query, $search) {
                // Dibungkus function($q) agar TIDAK bocor ke data user lain
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('notes.index', compact('notes', 'search'));
    }

    public function create()
    {
        Gate::authorize('create', Note::class);
        return view('notes.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Note::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->notes()->create($validated);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil ditambahkan.');
    }

    public function edit(Note $note)
    {
        Gate::authorize('update', $note);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus.');
    }
}
