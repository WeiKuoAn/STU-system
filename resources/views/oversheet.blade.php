<x-app-layout>
    <x-slot name="header">

        <div class="container">
            <div class="row">
                <div class="col-10">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('結案紀錄') }}
                    </h2>
                </div>
                <div class="col-2">
                    <a href="{{ route('worksheet') }}"><button type="button" class="btn btn-outline-success mx-3">工作紀錄</button></a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg" id="workone">
                <div class="p-6 bg-white border-gray-200">
                    <form class="row row-cols-lg-auto align-items-center"
                        action="{{ route('oversheet.data') }}" method="GET">
                        @csrf
                        <div class="col">
                                <x-label for="name" :value="__('登錄日期：')" />
                        </div>
                        <div class="col">
                            <div>
                                <x-input id="name" class="block mt-1 w-full" type="date" name="startdate" value="{{ $request->startdate }}" />
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                至
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <x-input id="name" class="block mt-1 w-full" type="date" name="lastdate" value="{{ $request->lastdate }}" />
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <x-label for="name" :value="__('事由：')" />
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <x-input id="name" class="block mt-1 w-full"  type="text" name="title" value="{{ $request->title }}" />
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <x-label for="name" :value="__('聯絡人：')" />
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="person" value=""  size="16"/>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger">搜尋</button>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($oversheets as $oversheet)
            <form action="{{ route('oversheet.data',$oversheet->id) }}" method="POST">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5" id="workone">
                    <div class="p-6 bg-white border-gray-200">
                        <table class="table table-bordered" id="{{ $oversheet->id }}">
                            <tr>
                                <th scope="col" width="10%">登錄日期</th>
                                <th scope="col" width="20%">事由</th>
                                <th scope="col">資料放置</th>
                                <th scope="col">事件人通訊</th>
                                <th scope="col">處理情況</th>
                            </tr>
                            <tr>
                                <td width="8%" align="center" valign="middle">{{ date('Y-m-d', strtotime($oversheet->created_at)) }}</td>
                                <td valign="middle">{{ $oversheet->title }}</td>
                                <td width="12%" align="center" valign="middle">{{ $oversheet->data_where }}</td>
                                <td align="center" valign="middle" class="content" >{{ $oversheet->contact_person }}</td>
                                <td class="content" valign="middle" width="40%" align="left">{{ $oversheet->condition }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="modal-footer">
                        <b></b>            
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            結案時間：{{ date('Y-m-d', strtotime($oversheet->updated_at)) }}，結案人：{{ $oversheet->over_username->name }}
                        </div>
                        <div>
                        <button type="submit" class="btn btn-primary" id="work_update" name="work_update" value="{{ $oversheet->id }}" onclick="alert('是否確定還原？')" >還原</button>
                        </div>                
                    </div>
                </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<style>
    th {
        text-align: center;
    }

    .modal-footer {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        padding: 0.75rem;
        border-top: none;
        border-bottom-right-radius: calc(0.3rem - 1px);
        border-bottom-left-radius: calc(0.3rem - 1px);
        margin-top: -40px;
    }

    div#workone {
        margin-top: -5px;
    }

    .content {
        white-space: pre;
    }

</style>

