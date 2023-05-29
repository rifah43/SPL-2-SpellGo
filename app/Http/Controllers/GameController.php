<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Level;
use App\Models\Progress;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function check(){
        $user = auth()->user();

        if ($user->role !== 'user') {
            return redirect()->route('dashboard');
        }
        return view('game');
    }
    public function checkProgress(){
        $user = auth()->user();
        $completedLevels = Progress::where('user_id', $user->id)->where('is_complete', 1)->get();
        $levels = Level::all();
        $sum = Reward::where('user_id', $user->id)->sum('points');

        return response()->json([
            'completedLevels' => $completedLevels,
            'levels' => $levels,
            'sum' => $sum,
        ]);
    }
    public function gameReward(Request $request)
{
    $score = $request->input('score');
    $bestTime = $request->input('bestTime');
    $levelId = $request->input('levelId');
    $user = Auth::user();

    $reward = Reward::create([
        'user_id' => $user->id,
        'points' => $score,
    ]);

    $progress = Progress::where('level_id', $levelId)
    ->where('user_id', $user->id)
    ->first();

if ($progress) {
    if ($progress->best_score < $score) {
        $progress->best_score = $score;
        $progress->best_time = $bestTime;
        $progress->save();
    }
} else {
    $progress = Progress::where('level_id', $levelId)
        ->where('user_id', $user->id)
        ->delete();

    $progress = Progress::create([
        'level_id' => $levelId,
        'user_id' => $user->id,
        'best_score' => $score,
        'best_time' => $bestTime,
        'is_complete' => 1,
    ]);
}



    return response()->json([
        'success' => true,
        'message' => 'Data stored successfully',
    ]);
}

}
