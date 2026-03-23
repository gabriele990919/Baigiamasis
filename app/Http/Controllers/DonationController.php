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

    $story = Story::findOrFail($story_id);

    // ❌ negali donate sau
    if ($story->user_id == auth()->id()) {
        return response()->json([
            'error' => 'You cannot donate to your own story'
        ], 403);
    }

    // create donation
    Donation::create([
        'user_id' => auth()->id(),
        'story_id' => $story_id,
        'amount' => $request->amount
    ]);

    // update collected
    $story->increment('collected_amount', $request->amount);

    return response()->json([
        'success' => true
    ]);
}
}