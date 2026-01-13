<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoodEntry;
use App\Models\Mood;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $lastWeek = Carbon::now()->subDays(7);
        $previousWeek = Carbon::now()->subDays(14);

        // =========================
        // SUMMARY
        // =========================

        // Total input 7 hari terakhir
        $weeklyTotal = MoodEntry::where('created_at', '>=', $lastWeek)->count();

        // Total input minggu sebelumnya (untuk growth)
        $previousWeeklyTotal = MoodEntry::whereBetween('created_at', [
            $previousWeek,
            $lastWeek
        ])->count();

        $weeklyGrowth = $previousWeeklyTotal > 0
            ? round((($weeklyTotal - $previousWeeklyTotal) / $previousWeeklyTotal) * 100)
            : 0;

        // Mood negatif
        $negativeMoods = ['Sedih', 'Cemas', 'Marah', 'Sangat Marah'];

        $weeklyNegative = MoodEntry::where('created_at', '>=', $lastWeek)
            ->whereHas('mood', function ($q) use ($negativeMoods) {
                $q->whereIn('nama_mood', $negativeMoods);
            })
            ->count();

        $previousNegative = MoodEntry::whereBetween('created_at', [
            $previousWeek,
            $lastWeek
        ])->whereHas('mood', function ($q) use ($negativeMoods) {
            $q->whereIn('nama_mood', $negativeMoods);
        })->count();

        $negativeGrowth = $previousNegative > 0
            ? round((($weeklyNegative - $previousNegative) / $previousNegative) * 100)
            : 0;

        // =========================
        // DISTRIBUSI MOOD
        // =========================
        $moodStats = Mood::select(
                'moods.nama_mood',
                DB::raw('COUNT(mood_entries.id) as total')
            )
            ->leftJoin('mood_entries', 'moods.id', '=', 'mood_entries.mood_id')
            ->groupBy('moods.nama_mood')
            ->orderByDesc('total')
            ->get();

        // =========================
        // INSIGHT
        // =========================

        $mostMood = optional($moodStats->first())->nama_mood;

        $activeHour = MoodEntry::select(DB::raw('HOUR(created_at) as hour'))
            ->groupBy('hour')
            ->orderByRaw('COUNT(*) DESC')
            ->value('hour');

        $worstDay = MoodEntry::select(DB::raw('DAYNAME(created_at) as day'))
            ->whereHas('mood', function ($q) use ($negativeMoods) {
                $q->whereIn('nama_mood', $negativeMoods);
            })
            ->groupBy('day')
            ->orderByRaw('COUNT(*) DESC')
            ->value('day');

        $inactiveUsers = User::whereDoesntHave('moodEntries', function ($q) use ($lastWeek) {
            $q->where('created_at', '>=', $lastWeek);
        })->count();

        // =========================
        // WARNING SYSTEM
        // =========================
        $warningUsers = MoodEntry::select(
                'user_id',
                DB::raw('COUNT(*) as days')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(5))
            ->whereHas('mood', function ($q) use ($negativeMoods) {
                $q->whereIn('nama_mood', $negativeMoods);
            })
            ->groupBy('user_id')
            ->having('days', '>=', 3)
            ->with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->user->name ?? 'Unknown',
                    'days' => $item->days,
                ];
            });

        // =========================
        // RETURN VIEW
        // =========================
        return view('admin.analytics', [
            'weeklyTotal' => $weeklyTotal,
            'weeklyNegative' => $weeklyNegative,
            'weeklyGrowth' => $weeklyGrowth,
            'negativeGrowth' => $negativeGrowth,
            'moodStats' => $moodStats->pluck('total', 'nama_mood'),
            'mostMood' => $mostMood,
            'worstDay' => $worstDay,
            'activeHour' => $activeHour,
            'inactiveUsers' => $inactiveUsers,
            'warningUsers' => $warningUsers,
        ]);
    }
}
