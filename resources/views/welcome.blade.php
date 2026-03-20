<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            Stories
        </h1>

        <a href="/create"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl transition">
            + Create Story
        </a>
    </div>

    {{-- PINTEREST GRID 🔥 --}}
    <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">

        @foreach($stories as $story)

        <div class="break-inside-avoid bg-white/70 dark:bg-gray-800/70 backdrop-blur-md p-4 rounded-2xl shadow hover:shadow-xl transition">

            {{-- IMAGE --}}
           @if($story->main_image)
        <img 
        src="{{ asset('storage/'.$story->main_image) }}"
        class="w-full object-cover rounded-xl mb-3 
        {{ ['h-40','h-60','h-80'][array_rand([0,1,2])] }}"
        >
        @endif


            {{-- CONTENT --}}
            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                {{ $story->content }}
            </p>

            {{-- MONEY --}}
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                🎯 Target: {{ $story->target_amount }} €
            </p>

            <p class="text-sm text-green-500">
                💰 Collected: {{ $story->collected_amount }} €
            </p>

            {{-- LIKES --}}
            <p class="text-sm text-pink-500 mt-2">
                ❤️ {{ $story->likes->count() }} likes
            </p>

            {{-- LIKE BUTTON --}}
            <form action="/like/{{$story->id}}" method="POST" class="mt-2">
                @csrf
                <button class="text-pink-500 hover:scale-110 transition">
                    ❤️ Like
                </button>
            </form>

            {{-- DELETE --}}
            <form action="/story/{{$story->id}}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('Delete this story?')"
                    class="text-red-500 hover:text-red-700 text-sm">
                    Delete
                </button>
            </form>

        </div>

        @endforeach

    </div>

</div>

</x-app-layout>







