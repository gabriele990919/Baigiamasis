<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\StoryImage;
use App\Models\Hashtag;
use App\Models\Donation;
use App\Models\Like;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'target_amount',
        'user_id'
    ];

    public function images()
    {
        return $this->hasMany(StoryImage::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
