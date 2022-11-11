<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('修改密碼') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-6 offset-md-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('editpassword.data', $user->id) }}">
                        @csrf
                        <div style="color: red;">
                            *密碼請設定8碼以上。
                        </div>
                        <div class="mt-4">
                            <x-label for="password" :value="__('舊密碼')" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                value="" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="password_new" :value="__('新密碼')" />
                            <x-input id="password_new" class="block mt-1 w-full" type="password" name="password_new"
                                value="" required/>
                        </div>
                        <div class="mt-4">
                            <x-label for="password_conf" :value="__('請再次輸入新密碼')" />
                            <x-input id="password_conf" class="block mt-1 w-full" type="password" name="password_conf"
                                value="" required/>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <div><button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button></div>&nbsp;
                            <button type="submit" class="btn btn-primary">確定修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
