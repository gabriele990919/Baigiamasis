<x-app-layout>

<div class="max-w-3xl mx-auto p-6">

<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
    Stories
</h1>

<a href="/create" class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600">
    + Create Story
</a>

@foreach($stories as $story)

<div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-5 mt-6">

    {{-- IMAGE 🔥 --}}
   @if($story->main_image)
    <img src="{{ asset('storage/'.$story->main_image) }}" 
    class="w-full h-60 object-cover rounded-xl mb-4">
   @endif


    {{-- TEXT --}}
    <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
        {{ $story->content }}
    </p>

    {{-- TARGET --}}
    <p class="text-gray-600 dark:text-gray-300">
        🎯 Target: {{ $story->target_amount }} €
    </p>

    {{-- COLLECTED --}}
    <p class="text-green-500 font-semibold">
        💰 Collected: {{ $story->collected_amount }} €
    </p>

    {{-- LIKES --}}
    <p class="text-red-500">
        ❤️ Likes: {{ $story->likes->count() }}
    </p>

    {{-- LIKE BUTTON --}}
    <form action="/like/{{$story->id}}" method="POST" class="mt-2">
        @csrf
        <button class="text-red-500 hover:scale-110 transition">
            ❤️ Like
        </button>
    </form>

    {{-- DELETE --}}
    <form action="/story/{{$story->id}}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Delete this story?')"
        class="text-gray-500 hover:text-red-500">
            Delete
        </button>
    </form>

</div>

@endforeach

</div>

</x-app-layout>






