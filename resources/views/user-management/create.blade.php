<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('users')}}" class="inline-flex items-center gap-1 align-middle"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
              </svg>
            </a>
            {{ __('Generate users') }}
        </h2>
    </x-slot>
    <div
        class="w-1/2 mx-auto mt-12 py-12 sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                @if (session('error'))
                    <div class="bg-red-500 text-white p-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <label class="block mb-2">โรงเรียน/สังกัด</label>
                <select name="organization_id" class="border rounded w-full px-4 py-2">
                    @foreach($organizations as $organization)
                    <option value="{{$organization->id}}">{{$organization->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2">จำนวนผู้ใช้</label>
                <input type="number" name="number_of_users" required min="1" max="100" class="border rounded w-full px-4 py-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                  </svg>
                สร้างผู้ใช้
            </button>
        </form>
    </div>
</x-app-layout>
