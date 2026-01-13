<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:activities,id'
        ]);

        $user = Auth::user();
        $activityId = $request->id;

        $done = $user->activity_done ? json_decode($user->activity_done, true) : [];

        if (isset($done[$activityId])) {
            unset($done[$activityId]);
        } else {
            $done[$activityId] = true;
        }

        $user->activity_done = json_encode($done);
        $user->save();

        return back()->with('success', 'Status aktivitas diperbarui!');
    }
}
