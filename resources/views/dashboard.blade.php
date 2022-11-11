@extends('layouts.app')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white border-b border-gray-200 alert">
                    @if (Auth::user()->status == '1')
                        <div class="alert alert-danger" role="alert">
                            您無權限使用本系統！請連繫管理人員！！
                        </div>
                    @else
                        <div class="alert alert-primary" role="alert">
                            目前時間為 <b>{{ $now }}</b>
                        </div>
                        <form action="{{ route('dashboard.worktime') }}" method="POST">
                            @csrf
                            @if (!isset($work->worktime))
                                <button type="Submit" class="btn btn-primary" name="worktime" value="0">上班</button>
                                <button type="button" class="btn btn-success" name="overtime" value="1"
                                    id="overtime">加班</button>
                                <div id="overtimecontent">
                                    <br>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">加班原因</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea><br>
                                        <button type="Submit" class="btn btn-danger" name="overtime"
                                            value="1">送出</button>
                                    </div>
                                </div>
                            @elseif($work->dutytime != null)
                                <button type="Submit" class="btn btn-primary" name="worktime" value="0">上班</button>
                                <button type="button" class="btn btn-success" value="1" id="overtime">加班</button>
                                <div id="overtimecontent">
                                    <br>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">加班原因</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea><br>
                                        <button type="Submit" class="btn btn-danger" name="overtime"
                                            value="1">送出</button>
                                    </div>
                                </div>
                            @elseif($work->dutytime == null)
                                <button type="Submit" class="btn btn-danger" name="dutytime" value="2">下班</button>
                            @endif
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endSection