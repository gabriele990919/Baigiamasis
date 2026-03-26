<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    // 🔹 Rodo visas stories
public function index()
{
    $query = Story::query();

    // 👑 admin mato viską
    if(!(auth()->check() && auth()->user()->role === 'admin')){
        $query->where('is_approved', true);
    }

    // 🔍 filteriai
    if(request('filter') == 'likes'){
        $query->withCount('likes')->orderBy('likes_count','desc');
    }

    if(request('filter') == 'money'){
        $query->orderBy('collected_amount','desc');
    }

    if(request('filter') == 'new'){
        $query->orderBy('created_at','desc');
    }

    $stories = $query->with(['likes','donations.user'])->get();

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

        Story::create([
            'content' => $request->content,
            'target_amount' => $request->target_amount,
            'collected_amount' => 0,
            'user_id' => auth()->id(),
            'main_image' => $path,
            'is_approved' => false,
            'tags' => $request->tags,
        ]);

        return redirect('/');
    }

    // 🔹 DELETE
   public function destroy($id)
{
    $story = Story::findOrFail($id);

    if(auth()->user()->role !== 'admin'){
        abort(403);
    }

    $story->delete();

    return back();

    }

    public function approve($id)
{
    $story = Story::findOrFail($id);

    if(auth()->user()->role !== 'admin'){
        abort(403);
    }

    $story->is_approved = true;
    $story->save();

    return back();
}
}

