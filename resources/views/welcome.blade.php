<x-app-layout>

<div x-data="paymentModal()" class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Stories</h1>

        <a href="/create"
        class="bg-blue-500 text-white px-4 py-2 rounded-xl">
            + Create Story
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($stories as $story)

        <div class="bg-white dark:bg-gray-800 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

            @if($story->main_image)
                <img src="{{ asset('storage/'.$story->main_image) }}"
                     class="w-full rounded mb-3">
            @endif

            <p class="font-bold">{{ $story->content }}</p>

           {{-- MONEY --}}
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                Target: {{ $story->target_amount }} €
            </p>

            <p class="text-sm text-green-500">
                Collected: {{ $story->collected_amount }} €
            </p>

            {{-- PROGRESS BAR --}}
            @php
                $percent = $story->target_amount > 0 
                    ? ($story->collected_amount / $story->target_amount) * 100 
                    : 0;
            @endphp

            <div class="w-full bg-gray-300 rounded-full h-3 mt-2 overflow-hidden">
                <div 
                    class="bg-green-500 h-3 rounded-full transition-all duration-700 ease-out"
                    style="width: {{ min($percent,100) }}%">
                </div>
            </div>

            <p class="text-xs text-gray-500 mt-1">
                {{ round($percent) }}% funded
            </p>

            {{-- LIKES --}}
            <p class="text-sm text-pink-500 mt-2">
                ❤️ {{ $story->likes->count() }} likes
            </p>

            {{-- LIKE BUTTON --}}
            <form action="/like/{{$story->id}}" method="POST" class="mt-2">
                @csrf
                <button class="text-pink-500 hover:scale-125 active:scale-150 transition duration-200">
                    ❤️ Like
                </button>
            </form>

            <button 
                @click="open = true; storyId = {{ $story->id }}"
                class="mt-3 bg-green-500 text-white px-3 py-1 rounded">
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

    <!-- 💳 MODAL -->
    <div x-show="open"
         x-transition
         style="display:none"
         class="fixed inset-0 flex items-center justify-center bg-black/50">

        <div class="bg-white p-6 rounded-xl w-96 text-center"
             @click.outside="open = false">

            <!-- FORM -->
            <template x-if="step === 'form'">
                <div>
                    <h2 class="text-xl mb-4">💳 Payment</h2>

                    <input type="number" x-model="amount"
                           placeholder="Amount (€)"
                           class="w-full p-2 border mb-2">

                    <button @click="pay()"
                            class="w-full bg-green-500 text-white py-2 rounded">
                        Pay
                    </button>

                    <button @click="open = false"
                            class="mt-2 text-gray-500">
                        Cancel
                    </button>
                </div>
            </template>

            <!-- LOADING -->
            <template x-if="step === 'loading'">
                <p>Processing... ⏳</p>
            </template>

            <!-- SUCCESS -->
            <template x-if="step === 'success'">
                <div>
                    <p class="text-xl">✅ Success!</p>
                    <button @click="finish()"
                            class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                        Close
                    </button>
                </div>
            </template>

        </div>
    </div>

</div>

</x-app-layout>








