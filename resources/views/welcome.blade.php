<x-app-layout>

<div x-data="{ open: false, storyId: null }" class="max-w-7xl mx-auto p-6">

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

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($stories as $story)

        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-md p-4 rounded-2xl shadow hover:shadow-xl transition">

            {{-- IMAGE --}}
            @if($story->main_image)
                <img 
                    src="{{ asset('storage/'.$story->main_image) }}"
                    class="w-full rounded-xl mb-3"
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

            @php
            $percent = $story->target_amount > 0 
            ? ($story->collected_amount / $story->target_amount) * 100 
            : 0;
            @endphp

            {{-- PROGRESS BAR --}}
            <div class="w-full bg-gray-300 rounded-full h-3 mt-2">
                <div class="bg-green-500 h-3 rounded-full transition-all duration-500"
                style="width: {{ min($percent,100) }}%">
                </div>
            </div>

            <p class="text-xs text-gray-500 mt-1">
                {{ round($percent) }}% funded
            </p>

            {{-- DONORS --}}
            @if($story->donations->count() > 0)
            <div class="mt-3 text-sm text-gray-400">
                <p class="font-semibold mb-1">Donors:</p>

                @foreach($story->donations->take(3) as $donation)
                <p>
                    💸 {{ $donation->user->name }} - {{ $donation->amount }}€
                </p>
                @endforeach
            </div>
            @endif

            {{-- LIKES --}}
            <p class="text-sm text-pink-500 mt-2">
                ❤️ {{ $story->likes->count() }} likes
            </p>

            {{-- LIKE --}}
            <form action="/like/{{$story->id}}" method="POST" class="mt-2">
                @csrf
                <button class="text-pink-500 hover:scale-110 transition">
                    ❤️ Like
                </button>
            </form>

            {{-- DONATE BUTTON --}}
            <button 
                @click="open = true; storyId = {{ $story->id }}"
                class="mt-3 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg">
                Donate
            </button>

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

    {{-- 🔥 FAKE STRIPE MODAL --}}
    <div 
        x-show="open"
        x-transition
        style="display: none;"
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">

        <div class="bg-white rounded-2xl p-6 w-96 shadow-xl"
             @click.outside="open = false">

            <h2 class="text-xl font-bold mb-4">💳 Payment</h2>

            <form :action="'/donate/' + storyId" method="POST" class="space-y-3">
                @csrf

                <input type="number" name="amount" placeholder="Amount (€)"
                    class="w-full p-2 border rounded text-black" required>

                <input type="text" placeholder="Card number"
                    class="w-full p-2 border rounded text-black" required>

                <div class="flex gap-2">
                    <input type="text" placeholder="MM/YY"
                        class="w-1/2 p-2 border rounded text-black" required>

                    <input type="text" placeholder="CVC"
                        class="w-1/2 p-2 border rounded text-black" required>
                </div>

                <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                    Pay
                </button>

                <button type="button" 
                    @click="open = false"
                    class="w-full text-gray-500 mt-2">
                    Cancel
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>









