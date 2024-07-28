<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ตารางคะแนน') }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex justify-end mb-4">
            <x-link-button href="{{ route('user-scores.export') }}">
                ส่งออกคะแนน
            </x-link-button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-dark">
                        <th class="py-2 px-4 border-b">รหัสผู้ใช้</th>
                        <th class="py-2 px-4 border-b">ชื่อ นามสกุล</th>
                        <th class="py-2 px-4 border-b">คะแนน</th>
                        <th class="py-2 px-4 border-b">เมื่อ</th>
                        <th class="py-2 px-4 border-b"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userScores as $userScore)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $userScore->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->score }}</td>
                            <td class="py-2 px-4 border-b">{{ $userScore->timestamp }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('user-scores.show', $userScore->user) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                    View
                                </a>
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
@vite(['resources/js/score.js'])