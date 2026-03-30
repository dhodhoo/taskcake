<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $search = $request->input('search');

        $schedules = $user->schedules()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('schedule_date')
            ->orderBy('schedule_time')
            ->paginate(5) // Batasi 5 jadwal per halaman
            ->withQueryString();

        return view('schedules.index', compact('schedules', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'description' => 'nullable|string'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->schedules()->create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        // Keamanan: Cegah user edit jadwal orang lain
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'description' => 'nullable|string'
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
