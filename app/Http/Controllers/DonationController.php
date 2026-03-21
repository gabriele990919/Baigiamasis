<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Story;

class DonationController extends Controller
{
    public function store(Request $request, $story_id)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
        ]);

        // sukuriam donation
        Donation::create([
            'user_id' => auth()->id(),
            'story_id' => $story_id,
            'amount' => $request->amount
        ]);

        // update collected_amount 🔥
        $story = Story::findOrFail($story_id);
        $story->collected_amount += $request->amount;
        $story->save();

        return back();
    }
}