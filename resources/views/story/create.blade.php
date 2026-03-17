<x-app-layout>

<h1 class="text-2xl font-bold mb-6 text-center">Create Story</h1>

<div class="max-w-md mx-auto bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-6">

<form action="/store" method="POST" enctype="multipart/form-data" class="space-y-4">

    @csrf

    <div>
        <textarea name="content" placeholder="Write your story..."
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div>
        <input type="number" name="target_amount" placeholder="Target amount"
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <input type="file" name="image" class="w-full text-sm">
    </div>

    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
        Create
    </button>

</form>

</div>

</x-app-layout>


