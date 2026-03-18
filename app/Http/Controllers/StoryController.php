<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    // 🔹 Rodo visas stories
    public function index()
    {
        $stories = Story::with('likes')->get();

        return view('welcome', compact('stories'));
    }

    // 🔹 Create puslapis
    public function create()
    {
        return view('story.create');
    }

    // 🔹 STORE (SU IMAGE UPLOAD 🔥)
public function store(Request $request)
{
    $request->validate([
        'content' => 'required',
        'target_amount' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $path = null;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('stories', 'public');
    }

    \App\Models\Story::create([
        'content' => $request->content,
        'target_amount' => $request->target_amount,
        'collected_amount' => 0,
        'user_id' => auth()->id(),
        'main_image' => $path
    ]);

    return redirect('/');
}


    // 🔹 DELETE
    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        // (optional) ištrina ir paveikslą
        if ($story->main_image) {
            \Storage::disk('public')->delete($story->main_image);
        }

        $story->delete();

        return redirect('/');
    }
}

