<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('個人資訊') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-6 offset-md-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($success == '1')
                        <div class="alert alert-success" role="alert">
                            更新資訊成功！
                        </div>
                    @endif
                    <form method="POST" action="{{ route('person.data', Auth::user()->id) }}">
                        @csrf
                        <div>
                            <x-label for="name" :value="__('姓名')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $user->name }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="account" :value="__('帳號')" />
                            <x-input id="account" class="block mt-1 w-full" type="text" name="account"
                                value="{{ $user->account }}" />
                        </div>
                        <div class="mt-4">
                            <x-label for="email" :value="__('信箱')" />
                            @if ($user->email == null)
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    placeholder="尚未輸入" />
                            @else
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    value="{{ $user->email }}" />
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-label for="mobile" :value="__('電話')" />
                            @if ($user->mobile == null)
                                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                                    placeholder="尚未輸入" />
                            @else
                                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                                    value="{{ $user->mobile }}" />
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <div><button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
                            </div>&nbsp;
                            <button type="submit" class="btn btn-primary">修改資料</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
