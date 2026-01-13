<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mood;
use App\Models\MoodEntry;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMoods = MoodEntry::count();
        $totalActivities = Activity::count();

        $negativeMoodIds = Mood::whereIn('name', [
            'Sedih',
            'Sangat Sedih',
            'Marah',
            'Sangat Marah',
            'Cemas'
        ])->pluck('id');

        $negativeMoods = MoodEntry::whereIn('mood_id', $negativeMoodIds)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        $topMood = MoodEntry::select('mood_id', DB::raw('COUNT(*) as total'))
            ->groupBy('mood_id')
            ->orderByDesc('total')
            ->first();

        $topMoodName = $topMood
            ? Mood::find($topMood->mood_id)->name
            : '-';

        $activeHour = MoodEntry::select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('hour')
        ->orderByDesc('total')
        ->value('hour') ?? '-';

        $inactiveUsers = User::whereDoesntHave('moodEntries', function ($q) {
            $q->where('created_at', '>=', now()->subDays(7));
        })->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMoods',
            'totalActivities',
            'negativeMoods',
            'topMoodName',
            'activeHour',
            'inactiveUsers'
        ));
    }

    /* ================= USERS ================= */
    public function users()
    {
        $users = User::withCount('moodEntries')
            ->get()
            ->map(function ($user) {
                $user->is_active = $user->moodEntries()
                    ->where('created_at', '>=', now()->subDays(7))
                    ->exists();
                return $user;
            });

        return view('admin.users', compact('users'));
    }

    /* ================= ANALYTICS ================= */
    public function analytics()
    {
        $moodStats = MoodEntry::join('moods', 'mood_entries.mood_id', '=', 'moods.id')
            ->selectRaw('moods.name as mood, COUNT(*) as total')
            ->groupBy('moods.name')
            ->pluck('total', 'mood');

        $weeklyTotal = MoodEntry::where('created_at', '>=', now()->subDays(7))->count();

        $weeklyNegative = MoodEntry::join('moods', 'mood_entries.mood_id', '=', 'moods.id')
            ->whereIn('moods.name', [
                'Sedih',
                'Sangat Sedih',
                'Marah',
                'Sangat Marah',
                'Cemas'
            ])
            ->where('mood_entries.created_at', '>=', now()->subDays(7))
            ->count();

        return view('admin.analytics', compact(
            'moodStats',
            'weeklyTotal',
            'weeklyNegative'
        ));
    }

    /* ================= ACTIVITIES ================= */
    public function activities()
    {
        $activities = Activity::latest()->get();
        return view('admin.activities', compact('activities'));
    }
}
