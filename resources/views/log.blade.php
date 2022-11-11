<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('軌跡紀錄') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('userlog') }}">使用者管理-軌跡紀錄</a>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <a href="{{ route('worklog') }}">出勤管理-軌跡紀錄</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
