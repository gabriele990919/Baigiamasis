<x-app-layout>

<h1 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-gray-100">
    Create Story
</h1>

<div class="max-w-md mx-auto bg-white/70 dark:bg-gray-800/70 backdrop-blur-md shadow-lg rounded-2xl p-6">

<form action="/store" method="POST" enctype="multipart/form-data">


    @csrf

    {{-- STORY TEXT --}}
    <div>
        <textarea name="content" placeholder="Write your story..."
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 
        bg-transparent text-gray-900 dark:text-gray-100 
        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
    </div>

    {{-- TARGET AMOUNT --}}
    <div>
        <input type="number" name="target_amount" placeholder="Target amount (€)"
        class="w-full p-4 rounded-xl border border-gray-300 dark:border-gray-700 
        bg-transparent text-gray-900 dark:text-gray-100 
        placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    {{-- IMAGE UPLOAD --}}
    <div>
        <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
            Upload image
        </label>

        <input type="file" name="image"
        class="w-full text-gray-700 dark:text-gray-200 
        file:mr-4 file:py-2 file:px-4
        file:rounded-lg file:border-0
        file:bg-blue-500 file:text-white
        hover:file:bg-blue-600">
    </div>

    {{-- BUTTON --}}
    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
        Create
    </button>

</form>

</div>

</x-app-layout>




