<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Unlock;

class CustomizationController extends Controller
{
    public function check(){
        $user = auth()->user();
        $sum = Reward::where('user_id', $user->id)->sum('points');
        $minRequirement= Customization::all();
        $unlock=Unlock::where('user_id', $user->id)->where('unlock_status', 1)->pluck('customization_id');

        if ($user->role !== 'user') {
            return redirect()->route('dashboard');
        }
        return view('customize', compact('sum','minRequirement','unlock'));
    }
    public function store(Request $request)
    {
        $coins = $request->input('coins');
        $cust_id= $request->input('customizationId');
    
    $userId = auth()->id();

    Reward::where('user_id', $userId)->delete();
    $reward = new Reward();
    $reward->user_id = $userId;
    $reward->points = $coins;
    $reward->save();

    $unlock = new Unlock();
    $unlock->user_id = $userId;
    $unlock->customization_id = $cust_id;
    $unlock->unlock_status= 1;
    $unlock->save();
    }
}
