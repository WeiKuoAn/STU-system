<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('出勤管理-軌跡紀錄') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">操作</th>
                                <th scope="col">被編輯者</th>
                                <th scope="col">欄位</th>
                                <th scope="col">更新內容記錄</th>
                                <th scope="col">更新時間</th>
                                <th scope="col">編輯者</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($work_logs as $work_log)
                                <tr>
                                    <th scope="row">{{ $work_log->id }}</th>
                                    <td>
                                        @if ($work_log->type == '1')
                                            新增
                                        @elseif($work_log->type == '2')
                                            <b style="color: red">編輯</b>
                                        @else
                                            <b style="color:blue">刪除</b>
                                        @endif
                                    </td>
                                    <td>{{ $work_log->user->name }}</td>
                                    <td>{{ $work_log->name() }}</td>
                                    <td>{{ $work_log->comment() }}</td>
                                    <td>{{ $work_log->created_at }}</td>
                                    <td>{{ $work_log->update_user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $work_logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
