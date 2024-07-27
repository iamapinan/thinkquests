<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>
    <div
        class="container mt-12 py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="mb-4">
            <x-link-button href="{{ route('activity-logs.index') }}">
                Back to All Logs
            </x-link-button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-100 text-dark border border-gray-200">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Activity</th>
                        <th class="py-2 px-4 border-b">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityLogs as $activityLog)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $activityLog->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $activityLog->activity }}</td>
                            <td class="py-2 px-4 border-b">{{ $activityLog->created_at }}</td>
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