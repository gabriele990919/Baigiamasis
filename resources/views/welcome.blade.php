<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Stories
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@auth
<a href="/create" class="bg-blue-500 text-white px-4 py-2 rounded">
Create Story
</a>
@endauth

@if($stories->isEmpty())
<p class="mt-4">No stories yet</p>
@endif

@foreach($stories as $story)

<div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-6 mt-6 border border-gray-200 dark:border-gray-700 hover:scale-105 transition duration-300">


<p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
{{ $story->content }}
</p>

<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
🎯 Target: <span class="font-medium text-gray-800 dark:text-gray-200">
{{ $story->target_amount }} €
</span>
</p>

<p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
💰 Collected: <span class="font-medium text-green-600">
{{ $story->collected_amount }} €
</span>
</p>

<p class="text-sm text-gray-700 dark:text-gray-400 mt-2">
❤️ <span class="text-pink-500 font-semibold">
{{ $story->likes->count() }}
</span> likes
</p>


@auth
<form action="/like/{{$story->id}}" method="POST" class="mt-2">
@csrf
<button class="bg-pink-500 text-white px-3 py-1 rounded">
❤️ Like
</button>
</form>
@endauth

@auth
@if(auth()->id() == $story->user_id)

<form action="/story/{{$story->id}}" method="POST" class="mt-2">
@csrf
@method('DELETE')

<button
class="bg-red-500 text-white px-3 py-1 rounded"
onclick="return confirm('Delete this story?')">

Delete

</button>

</form>

@endif
@endauth

</div>

@endforeach

</div>
</div>

</x-app-layout>




