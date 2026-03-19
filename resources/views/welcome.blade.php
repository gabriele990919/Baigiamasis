<x-app-layout>

<h1 class="text-2xl font-bold mb-6 text-center">Stories</h1>

<div class="text-center mb-6">
    <a href="/create" class="bg-blue-500 text-white px-4 py-2 rounded-xl">
        + Create Story
    </a>
</div>

@foreach($stories as $story)

<div class="max-w-xl mx-auto bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-6 mb-6">

    {{-- IMAGE --}}
    @if($story->main_image)
        <img src="{{ asset('storage/'.$story->main_image) }}" 
        class="w-full h-48 object-cover rounded-xl mb-3">
    @endif

    {{-- CONTENT --}}

    <p>{{ $story->main_image }}</p>

    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
        {{ $story->content }}
    </p>

    {{-- TARGET --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        🎯 Target: 
        <span class="font-medium text-gray-800 dark:text-gray-200">
            {{ $story->target_amount }} €
        </span>
    </p>

    {{-- COLLECTED --}}
    <p class="text-sm text-gray-500 dark:text-gray-400">
        💰 Collected: 
        <span class="font-medium text-green-600">
            {{ $story->collected_amount }} €
        </span>
    </p>

    {{-- PROGRESS BAR --}}
    @php
        $percent = $story->target_amount > 0 
            ? ($story->collected_amount / $story->target_amount) * 100 
            : 0;
    @endphp

    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
        <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
            style="width: {{ $percent }}%">
        </div>
    </div>

    <p class="text-xs text-gray-500 mt-1">
        {{ round($percent) }}% funded
    </p>

    {{-- LIKES --}}
    <p class="text-sm mt-3 text-gray-500 dark:text-gray-400">
        ❤️ 
        <span class="text-red-500 font-semibold">
            {{ $story->likes->count() }}
        </span> likes
    </p>

    <form action="/like/{{$story->id}}" method="POST" class="mt-2">
        @csrf
        <button class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1 rounded-lg">
            ❤️ Like
        </button>
    </form>

    {{-- DONATE --}}
    <form action="/donate/{{$story->id}}" method="POST" class="mt-3 flex gap-2">
        @csrf
        <input type="number" name="amount" placeholder="€"
        class="w-24 p-2 rounded border border-gray-300">

        <button class="bg-green-500 hover:bg-green-600 text-white px-3 rounded">
            Donate
        </button>
    </form>

    {{-- DELETE --}}
    <form action="/story/{{$story->id}}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this story?')"
        class="text-red-500 hover:underline">
            Delete
        </button>
    </form>

</div>

@endforeach

</x-app-layout>





