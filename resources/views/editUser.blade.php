<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('編輯帳號') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-6 offset-md-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('editUser.data', $user->id) }}">
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
                        @if ($user->level == '2' || $user->level == '1')
                            <div class="mt-4">
                                <x-label for="email" :value="__('等級')" />
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="level" id="Radio1"
                                        value="1" @if ($user->level == '1') checked @endif>
                                    <label class="form-check-label" for="Radio1">管理者</label>
                                </div>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="level" id="Radio2"
                                        value="2" @if ($user->level == '2') checked @endif>
                                    <label class="form-check-label" for="Radio2">工讀生</label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-label for="email" :value="__('權限')" />
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                        value="0" @if ($user->status == '0') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">開通</label>
                                </div>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                        value="1" @if ($user->status == '1') checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">關閉</label>
                                </div>
                            </div>
                        @endif
                        <div class="flex items-center justify-end mt-4">
                            <div><button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button></div>&nbsp;
                            <div><button type="submit" class="btn btn-primary">修改資料</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
