<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // 1. Jadwal Hari Ini
        $todaySchedules = $user->schedules()
            ->whereDate('schedule_date', Carbon::today())
            ->orderBy('schedule_time')
            ->get();

        // 2. Jadwal Mendatang (Besok dan seterusnya, ambil 4 terdekat)
        $upcomingSchedules = $user->schedules()
            ->whereDate('schedule_date', '>', Carbon::today())
            ->orderBy('schedule_date')
            ->orderBy('schedule_time')
            ->take(4)
            ->get();

        // 3. Total Catatan (Untuk Widget)
        $notesCount = $user->notes()->count();

        // 4. Catatan Terbaru (Ambil 3 paling baru)
        $recentNotes = $user->notes()
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'todaySchedules',
            'upcomingSchedules',
            'notesCount',
            'recentNotes'
        ));
    }
}
