<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('บันทึกกิจกรรม เก็บย้อนหลัง 90 วัน') }} 
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-dark">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">User</th>
                        <th class="py-2 px-4 border-b">URL</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityLogs as $activityLog)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $activityLog->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $activityLog->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $activityLog->activity }}</td>
                            <td class="py-2 px-4 border-b">{{ $activityLog->created_at }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('activity-logs.show', $activityLog->user) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $activityLogs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>