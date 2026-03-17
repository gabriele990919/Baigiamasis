<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
public function up(): void
{
    Schema::create('hashtag_story', function (Blueprint $table) {
        $table->id();
        $table->foreignId('story_id')->constrained()->cascadeOnDelete();
        $table->foreignId('hashtag_id')->constrained()->cascadeOnDelete();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('hashtag_story');
    }
};
