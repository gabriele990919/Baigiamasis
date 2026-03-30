<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
     <div class="flex gap-4 mb-6 justify-center">

    <div class="flex-1 bg-gray-800/70 p-4 rounded-xl text-center border border-gray-700">
        <p class="text-gray-400 text-sm">Stories</p>
        <p class="text-2xl font-bold text-white">{{ $storiesCount }}</p>
    </div>

    <div class="flex-1 bg-gray-800/70 p-4 rounded-xl text-center border border-gray-700">
        <p class="text-gray-400 text-sm">Likes</p>
        <p class="text-2xl font-bold text-white">{{ $likesCount }}</p>
    </div>

    <div class="flex-1 bg-gray-800/70 p-4 rounded-xl text-center border border-gray-700">
        <p class="text-gray-400 text-sm">Donated</p>
        <p class="text-2xl font-bold text-green-400">{{ $donationsCount }} €</p>
    </div>

</div>

</div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
