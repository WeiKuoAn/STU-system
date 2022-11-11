<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('編輯工作紀錄') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-6 offset-md-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('editworksheet.data',$worksheet->id) }}">
                        @csrf
                        <!-- 事由 -->
                        <div class="mt-4">
                            <x-label for="title" :value="__('事由')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                               value="{{ $worksheet->title }}"  required  />
                        </div>

                        <!-- 資料放置位置 Address -->
                        <div class="mt-4">
                            <x-label for="data_where" :value="__('資料放置位置')" />

                            <x-input id="data_where" class="block mt-1 w-full" type="text" name="data_where"
                                value="{{ $worksheet->data_where }}"  required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="contact_person" :value="__('事件人通訊')" />
                            <textarea class="form-control" id="contact_person" rows="3" name="contact_person">{{ $worksheet->contact_person }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="condition" :value="__('處理情況')" />
                            <textarea class="form-control" id="condition" rows="10" name="condition">{{ $worksheet->condition }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('確定修改') }}
                            </x-button>
                            <x-button class="ml-4" onclick="history.go(-1)">
                                {{ __('回上一頁') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
