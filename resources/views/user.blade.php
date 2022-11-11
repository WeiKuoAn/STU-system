<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('用戶管理') }}
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
                                <th scope="col">姓名</th>
                                <th scope="col">帳號</th>
                                <th scope="col">權限</th>
                                <th scope="col">狀態</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->account }}</td>
                                    <td>
                                        @if ($user->level == '0')
                                            超級管理者
                                        @elseif($user->level == '2')
                                            工讀生
                                        @else
                                            管理者
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->status == '0')
                                            開通
                                        @elseif($user->status == '1')
                                            <b style="color:red;">關閉</b>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->level == '1' || $user->level == '2')
                                            <a href="{{ route('editUser', $user->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm">編輯</button>
                                            </a>
                                            <a href="{{ route('userwork', $user->id) }}">
                                                <button type="button" class="btn btn-danger btn-sm">出勤紀錄</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
