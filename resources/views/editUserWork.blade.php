<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('編輯出勤時間') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-6 offset-md-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('editUserWork.data', $work->id) }}">
                        @csrf
                        <div>
                            <x-label for="worktime" :value="__('上班時間')" />
                            <x-input id="worktime" class="block mt-1 w-full" type="text" name="worktime"
                                value="{{ $work->worktime }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="dutytime" :value="__('下班時間')" />
                            <x-input id="dutytime" class="block mt-1 w-full" type="text" name="dutytime"
                                value="{{ $work->dutytime }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="email" :value="__('狀態')" />
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0"
                                    @if ($work->status == '0') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">值班
                                </label>
                            </div>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1"
                                    @if ($work->status == '1') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">加班</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-label for="total" :value="__('上班總時數')" />
                            <x-input id="total" class="block mt-1 w-full" type="text" name="total"
                                value="{{ $work->total }}" />
                        </div>
                        <div class="mt-4">
                            <label for="exampleFormControlTextarea1" class="form-label">備註</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="remark">{{ $work->remark }}</textarea><br>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <div><button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button></div>&nbsp;
                            <button type="submit" class="btn btn-primary">修改資料</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
