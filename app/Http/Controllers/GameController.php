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
        $sum = Reward::all()->sum('points');

        return response()->json([
            'completedLevels' => $completedLevels,
            'levels' => $levels,
            'sum' => $sum,
        ]);
    }
}
