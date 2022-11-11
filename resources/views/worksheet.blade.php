@extends('layouts.app')

@section('main-content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg alert">
                    <div class="bg-white border-b border-gray-200 mt-3">
                    <form class="row row-cols-lg-auto align-items-center" action="{{ route('worksheet') }}"
                        method="GET">
                        @csrf
                        <div class="col">
                            <x-label for="name" :value="__('登錄日期：')" />
                        </div>
                        <div class="col">
                            <input
                                  class="form-control"
                                  type="date"
                                  id="startdate"
                                  name="startdate"
                                  value="{{ $request->startdate }}"
                                  autofocus
                                />
                        </div>
                        <div class="col">
                            <div>
                                至
                            </div>
                        </div>
                        <div class="col">
                            <input
                                  class="form-control"
                                  type="date"
                                  id="lastdate"
                                  name="lastdate"
                                  value="{{ $request->lastdate }}"
                                  autofocus
                                />
                        </div>
                        <div class="col">
                            <div>
                                <x-label for="name" :value="__('事由：')" />
                            </div>
                        </div>
                        <div class="col">
                            <input
                                  class="form-control"
                                  type="text"
                                  id="title"
                                  name="title"
                                  value="{{ $request->title  }}"
                                  autofocus
                                />
                        </div>
                        <div class="col">
                            <div>
                                <x-label for="name" :value="__('聯絡人：')" />
                            </div>
                        </div>
                        <div class="col">
                            <input
                                  class="form-control"
                                  type="text"
                                  id="person"
                                  name="person"
                                  value="{{ $request->person  }}"
                                  autofocus
                                />
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger">搜尋</button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach ($worksheets as $worksheet)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 alert" id="workone">
                    <div class="p-6 bg-white border-gray-200 ">
                        <table class="table table-bordered" id="{{ $worksheet->id }}">
                            <tr align="center">
                                <th scope="col" width="10%">登錄日期</th>
                                <th scope="col" width="16%">事由</th>
                                <th scope="col" width="12%">資料放置</th>
                                <th scope="col" width="20%">事件人通訊</th>
                                <th scope="col" width="42%">處理情況</th>
                            </tr>
                            <tr>
                                <td  align="center" valign="middle">
                                    {{ date('Y-m-d', strtotime($worksheet->created_at)) }}</td>
                                <td valign="middle" >{{ $worksheet->title }}</td>
                                <td  align="center" valign="middle">{{ $worksheet->data_where }}</td>
                                <td align="center" valign="middle" class="content" ><textarea class="form-control" id="condition" rows="10" name="condition">{{ $worksheet->contact_person }}</textarea></td>
                                <td class="content" valign="middle" ><textarea class="form-control" id="condition" rows="10" name="condition">{{ $worksheet->condition }}</textarea></td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer" >
                        <div class="col">
                            建立人：{{ $worksheet->create_username->name }}
                        </div>
                        <div class="mt-5">
                            <form action="{{ route('click_over_sheet.data', $worksheet->id) }}" method="POST">
                                @csrf
                                
                                <button type="submit" class="btn btn-primary" id="work_over" name="work_over"
                                    value="{{ $worksheet->id }}" onclick="alert('是否確定結案？')">結案</button>
                                    <a href="{{ route('editworksheet',$worksheet->id) }}"><button type="button" class="btn btn-dark" id="work_edit" name="work_edit" value="{{ $worksheet->id }}" >編輯</button></a>
                                    <button type="submit" class="btn btn-secondary" id="work_over" name="work_del"
                                    value="{{ $worksheet->id }}" onclick="alert('是否確定刪除？')">刪除</button>
                            </form>
                            
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endSection
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

    .form-control {
    border: none;
    }
</style>
