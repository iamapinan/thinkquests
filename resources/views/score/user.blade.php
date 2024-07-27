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
            <x-cancel-button href="{{ route('user-scores.index') }}">
                ย้อนกลับ
            </x-cancel-button>
            <x-link-button href="{{ route('user-scores.export') }}">
                ส่งออกคะแนน
            </x-link-button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Content</th>
                        <th class="py-2 px-4 border-b">Score</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userScores as $userScore)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $userScore->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->content->subject_topic }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->score }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->timestamp }}</td>
                            <td class="py-2 px-4 border-b w-2/6">
                            <form method="POST" action="{{ route('user-scores.edit', $userScore) }}">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $userScore->user_id }}">
                                <input type="hidden" name="content_id" value="{{ $userScore->content_id }}">
                                <input type="number" name="score" value="{{ $userScore->score }}" class="border-b border-gray-200 rounded">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                    Edit Score
                                </button>
                            </form>
                            </td>
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