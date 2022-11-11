@extends('layouts.app')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg alert">
                    <div class="bg-white border-b border-gray-200 mt-3">
                        <form class="row row-cols-lg-auto g-3 align-items-center"
                            action="{{ route('personwork') }}">
                            @csrf
                            <div class="col-12">
                                <label for="startdate" class="form-label">起始日</label>
                                <input
                                  class="form-control"
                                  type="date"
                                  id="startdate"
                                  name="startdate"
                                  value="{{ request('startdate') }}"
                                  autofocus
                                />
                              </div>
                              <div class="col-12">
                                <label for="enddate" class="form-label">結束日</label>
                                <input
                                  class="form-control"
                                  type="date"
                                  id="enddate"
                                  name="enddate"
                                  value="{{ request('enddate') }}"
                                  autofocus
                                />
                              </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary">搜尋</button>
                            </div>
                            <div class="col-12 mt-5">
                                <span style="font-size: 1.5em;">共<b
                                        style="font-size: 1.2em;color:red;">{{ $work_sum }}</b>小時</span>
                            </div>
                        </form>
                        <table class="table table-striped table-hover mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">上班時間</th>
                                    <th scope="col">下班時間</th>
                                    <th scope="col">狀態</th>
                                    <th scope="col">時間</th>
                                    <th scope="col">備註</th>
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
                                                <b>加班</b>
                                            @endif
                                        </td>
                                        <td>{{ $work->total }}</td>
                                        <td>{{ $work->remark }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $works->appends($condition)->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
