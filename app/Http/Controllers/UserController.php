<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Mood;
use App\Models\Journal;
use App\Models\Activity;
use App\Models\MoodEntry;

class UserController extends Controller
{
    // =============================
    // HALAMAN UTAMA
    // =============================
    public function index()
    {
        return view('landing');
    }

    // =============================
    // DASHBOARD USER
    // =============================
    public function dashboard()
    {
        $user = Auth::user();

        $moods = Mood::all();
        $journals = Journal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $activities = Activity::all();

        $stats = DB::table('mood_entries')
            ->join('moods', 'mood_entries.mood_id', '=', 'moods.id')
            ->select('moods.name', DB::raw('count(*) as jumlah'))
            ->where('mood_entries.user_id', $user->id)
            ->groupBy('moods.name')
            ->get();

        return view('user.dashboard', compact('user', 'moods', 'journals', 'activities', 'stats'));
    }

    // =============================
    // SIMPAN MOOD
    // =============================
    public function storeMood(Request $request)
    {
        $request->validate([
            'mood_id' => 'required|integer|exists:moods,id',
        ]);

        MoodEntry::create([
            'user_id' => Auth::id(),
            'mood_id' => $request->mood_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    // =============================
    // SIMPAN JURNAL
    // =============================
    public function storeJournal(Request $request)
    {
        $request->validate([
            'isi_jurnal' => 'required|string|max:1000',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'content' => $request->isi_jurnal,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Jurnal berhasil disimpan!');
    }

    // =============================
    // RIWAYAT MOOD
    // =============================
    public function riwayatMood()
    {
        $entries = MoodEntry::with('mood')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.riwayat', compact('entries'));
    }

    // =============================
    // AKTIVITAS USER
    // =============================
    public function aktivitas()
    {
        $activities = Activity::all();
        $userActivityStatus = [];

        return view('user.aktivitas', compact('activities', 'userActivityStatus'));
    }

    // =============================
    // GAME RINGAN
    // =============================
    public function game()
    {
        return view('user.game');
    }

    // =============================
    // INSIGHT
    // =============================
    public function insight()
    {
        $userId = Auth::id();

        $emoji = [
            'Bahagia' => '🤩',
            'Senang' => '😄',
            'Bimbang' => '😕',
            'Cemas' => '😰',
            'Biasa Saja' => '😐',
            'Sedih' => '😢',
            'Sangat Sedih' => '😭',
            'Marah' => '😠',
            'Sangat Marah' => '😡',
        ];

        $total = MoodEntry::where('user_id', $userId)->count();

        $mostMood = DB::table('mood_entries')
            ->join('moods', 'mood_entries.mood_id', '=', 'moods.id')
            ->select('moods.name', DB::raw('COUNT(*) as total'))
            ->where('mood_entries.user_id', $userId)
            ->groupBy('moods.name')
            ->orderByDesc('total')
            ->first();

        $activeDays = DB::table('mood_entries')
            ->where('user_id', $userId)
            ->distinct()
            ->count(DB::raw('DATE(created_at)'));

        $dates = DB::table('mood_entries')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->pluck('created_at')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->unique()
            ->values();

        $streak = 1;
        $temp = 1;

        for ($i = 1; $i < count($dates); $i++) {
            if (Carbon::parse($dates[$i])->diffInDays(Carbon::parse($dates[$i - 1])) == 1) {
                $temp++;
            } else {
                $streak = max($streak, $temp);
                $temp = 1;
            }
        }

        $streak = max($streak, $temp);

        $byMood = DB::table('mood_entries')
            ->join('moods', 'mood_entries.mood_id', '=', 'moods.id')
            ->select('moods.name', DB::raw('COUNT(*) as jumlah'))
            ->where('mood_entries.user_id', $userId)
            ->groupBy('moods.name')
            ->get();

        $trend = DB::table('mood_entries')
            ->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as count'))
            ->where('user_id', $userId)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('day', 'asc')
            ->limit(14)
            ->get();

        return view('user.insight', compact(
            'byMood',
            'trend',
            'mostMood',
            'activeDays',
            'streak',
            'emoji',
            'total'
        ));
    }

    // =============================
    // PROFIL
    // =============================
    public function profil()
    {
        return view('user.profil', ['user' => Auth::user()]);
    }

    // UPDATE PROFIL
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!password_verify($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah!']);
        }

        Auth::user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diupdate!');
    }
}
