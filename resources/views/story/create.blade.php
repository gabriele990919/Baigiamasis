<x-app-layout>

<h1 class="text-2xl font-bold mb-6 text-center">Create Story</h1>

<div class="max-w-md mx-auto bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-6">

<form action="/store" method="POST" class="space-y-4">

    @csrf

    <div>
        <textarea name="content" style="color: black;" placeholder="Write your story..."
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400"></textarea>
    </div>

    <div>
        <input type="number" name="target_amount" style="color: black;" placeholder="Target amount"
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400"></textarea>
    </div>

    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
        Create
    </button>

</form>

</div>

</x-app-layout>

