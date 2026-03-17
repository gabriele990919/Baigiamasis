<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{

    public function store($story_id)
    {

        $exists = Like::where('user_id', auth()->id())
        ->where('story_id', $story_id)
        ->exists();

        if(!$exists){

            Like::create([
                'user_id' => auth()->id(),
                'story_id' => $story_id
            ]);

        }

        return back();
    }

}

