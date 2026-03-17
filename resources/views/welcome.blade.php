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

<div class="bg-white shadow rounded p-6 mt-6">

<p class="text-lg font-bold">
{{ $story->content }}
</p>

<p class="text-gray-600">
Target: {{ $story->target_amount }}
</p>

<p class="text-gray-600">
Collected: {{ $story->collected_amount }}
</p>

<p class="text-red-500">
❤️ Likes: {{ $story->likes->count() }}
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




