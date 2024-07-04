<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User namagement') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        <h1 class="text-2xl font-bold text-start mb-4">{{ $user->name }}'s Scores</h1>
        <div class="flex justify-end mb-4 gap-1">
            <x-link-button href="{{ route('user-scores.index') }}">
                Back
            </x-link-button>
            <x-link-button href="{{ route('user-scores.export') }}">
                Export
            </x-link-button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Content</th>
                        <th class="py-2 px-4 border-b">Score</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userScores as $userScore)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $userScore->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->content->subject_topic }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->score }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->timestamp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $userScores->links() }}
            </div>
        </div>
    </div>
</x-app-layout>