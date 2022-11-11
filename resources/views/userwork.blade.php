<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span style="color:red;">{{ $user->name }}</span>－{{ __('出勤紀錄') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="row row-cols-lg-auto g-3 align-items-center"
                        action="{{ route('userwork', $user->id) }}">
                        @csrf
                        <div class="col-12">
                            <div>
                                <x-label for="name" :value="__('起始日')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <x-input id="name" class="block mt-1 w-full" type="date" name="startdate" value=""
                                    placeholder="Disabled input" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <x-label for="name" :value="__('結束日')" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <x-input id="name" class="block mt-1 w-full" type="date" name="enddate" value="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">搜尋</button>
                        </div>
                        <div class="col-md-3 offset-md-3">
                            <span style="font-size: 1.5em;">共<b style="font-size: 1.2em;color:red;">{{ $work_sum }}</b>小時</span>
                        </div>
                    </form>
                    <br>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">日期</th>
                                <th scope="col">上班時間</th>
                                <th scope="col">下班時間</th>
                                <th scope="col">狀態</th>
                                <th scope="col">時間</th>
                                <th scope="col">備註</th>
                                <th scope="col">操作</th>
                                {{-- <th scope="col">操作</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($works as $work)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($work->worktime)) }}</td>
                                    <td>{{ date('H:i', strtotime($work->worktime)) }}</td>
                                    <td>
                                        @if ($work->dutytime != null)
                                            {{ date('H:i', strtotime($work->dutytime)) }}
                                        @else
                                            <b><span style="color: red;">尚未下班</span></b>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($work->status == '0')
                                            值班
                                        @else
                                            <b style="color:red;">加班</b>
                                        @endif
                                    </td>
                                    <td>{{ $work->total }}</td>
                                    <td>{{ $work->remark }}</td>
                                    <td>
                                        <a href="{{ route('editUserWork', $work->id) }}">
                                            <button type="button" class="btn btn-primary btn-sm">編輯</button>
                                        </a>
                                        <a href="{{ route('delUserWork', $work->id) }}"><button type="button"
                                                class="btn btn-danger btn-sm">刪除
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $works->appends($condition)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
