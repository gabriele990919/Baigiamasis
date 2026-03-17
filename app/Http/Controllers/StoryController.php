<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{

  public function index()
{
    $stories = Story::all();

    return view('welcome', compact('stories'));
}

    public function create()
    {
        return view('story.create');
    }

    public function store(Request $request)
    {

        Story::create([
            'content' => $request->content,
            'target_amount' => $request->target_amount,
            'user_id' => auth()->id()
        ]);

        return redirect('/');
    }

    public function destroy($id)
{
    $story = Story::findOrFail($id);

    $story->delete();

    return redirect('/');
}


}
