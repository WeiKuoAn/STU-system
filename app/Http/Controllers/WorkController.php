<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Works;
use App\Models\User;
use App\Models\WorkLog;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == '0') {
            return redirect()->action([UserController::class, 'index']);
        } else {
            $now = Carbon::now();
            $work = Works::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
            return view('dashboard')->with(['now' => $now, 'work' => $work]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now = Carbon::now();
        //0是上班，1是中途上班，2是加班，3是下班
        if ($request->worktime == '0') {
            $work = new Works;
            $work->user_id = Auth::user()->id;
            $work->worktime = $now;
            $work->status = '0';
            $work->remark = ' ';
            $work->save();
            $work = Works::orderBy('id', 'desc')->first();
        } elseif ($request->overtime == '1') {
            $work = new Works;
            $work->user_id = Auth::user()->id;
            $work->worktime = $now;
            $work->status = '1';
            $work->remark = $request->remark;
            $work->save();
        } elseif ($request->dutytime == '2') {
            //判斷每個使用者的最新的一筆打卡紀錄，一定要where user，否則其他user點選下班會相衝突。
            $worktime = Works::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
            if ($worktime->worktime != null) {
                $worktime->dutytime = $now;
                $worktime->total = Works::work_sum($worktime->id);
                $worktime->save();
            }
        }
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showuserwork($workId)
    {
        if (Auth::user()->level == '0') {
            $work = Works::where('id', $workId)->first();
            return view('editUserWork')->with(['work' => $work]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function edituserwork(Request $request, $workId)
    {
        $work = Works::where('id', $workId)->first();

        $old_worktime = $work->worktime;
        $old_dutytime = $work->dutytime;
        $old_status = $work->status;
        $old_remark = $work->remark;
        $old_total = $work->total;

        $userId = $work->user_id;
        $work->worktime = $request->worktime;
        $work->dutytime = $request->dutytime;
        $work->status = $request->status;
        $work->total = $request->total;
        if ($request->remark == '') {
            $work->remark = '';
        } else {
            $work->remark = $request->remark;
        }
        $work->save();

        //軌跡紀錄新增
        if ($old_worktime != $request->worktime || $old_dutytime != $request->dutytime || $old_status != $request->status || $old_remark != $request->remark || $old_total!=$request->total) {
            $work_log = new WorkLog;
            $work_log->type = '2';//編輯的號碼
            $work_log->user_id = $userId;
            $work_log->name = ' ';
            $work_log->comment = ' ';

            if ($old_worktime != $request->worktime) {
                $work_log->name .= '上班時間' . "*";
                $work_log->comment .= $old_worktime . "→" . $request->worktime . "*";
            }
            if ($old_dutytime != $request->dutytime) {
                $work_log->name .= '下班時間' . "*";
                $work_log->comment .= $old_dutytime . "→" . $request->dutytime . "*";
            }
            if ($old_status != $request->status) {
                if ($old_status == '0') {
                    $old_status_str = '值班';
                } else if ($old_status == '1') {
                    $old_status_str = '加班';
                }
                if ($request->status == '0') {
                    $request_status_str = '值班';
                } else if ($request->status == '1') {
                    $request_status_str = '加班';
                }
                $work_log->name .= '上班狀態' . "*";
                $work_log->comment .= $old_status_str . "→" . $request_status_str . "*";
            }
            if ($old_total != $request->total) {
                $work_log->name .= '總時數' . "*";
                $work_log->comment .= $old_total . "→" . $request->total . "*";
            }
            if ($old_remark != $request->remark) {
                if ($old_remark == '') {
                    $old_remark_str = '無';
                } else {
                    $old_remark_str = $old_remark;
                }
                if ($request->remark == '') {
                    $request_remark_str = '無';
                } else {
                    $request_remark_str = $request->remark;
                }
                $work_log->name .= '備註' . "*";
                $work_log->comment .= $old_remark_str . "→" . $request_remark_str . "*";
            }
            $work_log->Update_at = Auth::user()->id;
            $work_log->save();
        }

        return redirect()->route('userwork', $userId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {
        // $now = Carbon::now();
        // if($request->dutytime == 'dutytime'){
        //     $work = new Works;
        //     $work->user_id = Auth::user()->id;
        //     $work->worktime = $now;
        //     $work->dutytime = ' ';
        //     $work->status = '0';
        //     $work->remark = ' ';
        //     $work->save();
        // }
        // return view('dashboard')->with(['now'=>$now]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function showdeluserwork($workId)
    {
        if (Auth::user()->level == '0') {
            $work = Works::where('id', $workId)->first();
            return view('delUserWork')->with(['work' => $work]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deluserwork($workId)
    {
        $work = Works::where('id', $workId)->first();
        $userId = $work->user_id;
        $work->delete();

        $old_worktime = $work->worktime;
        $old_dutytime = $work->dutytime;
        $old_status = $work->status;
        $old_remark = $work->remark;

        $work_log = new WorkLog;
        $work_log->type = '3';
        $work_log->user_id = $userId;
        $work_log->name = ' ';
        $work_log->comment = ' ';

        $work_log->name .= '上班時間' . "*";
        $work_log->comment .= $old_worktime . "*";

        $work_log->name .= '下班時間' . "*";
        $work_log->comment .= $old_dutytime  . "*";

        if ($old_status == '0') {
            $old_status_str = '值班';
        } else if ($old_status == '1') {
            $old_status_str = '加班';
        }
        $work_log->name .= '上班狀態' . "*";
        $work_log->comment .= $old_status_str . "*";
        if ($old_remark == '') {
            $old_remark_str = '無';
        } else {
            $old_remark_str = $old_remark;
        }
        $work_log->name .= '備註' . "*";
        $work_log->comment .= $old_remark_str . "*";
        $work_log->Update_at = Auth::user()->id;
        $work_log->save();
        return redirect()->route('userwork', $userId);
    }

    public function personwork(Request $request) //個人出勤紀錄
    {
        if ($request->startdate && $request->enddate) {
            $works = Works::where('user_id', Auth::user()->id)->whereBetween('worktime', [$request->startdate, $request->enddate])->orderBy('id', 'desc')->paginate(7);
            $work_sum = Works::where('user_id', Auth::user()->id)->whereBetween('worktime', [$request->startdate, $request->enddate])->sum('total');
            $condition = $request->all();
        } else {
            $works = Works::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
            $work_sum = Works::where('user_id', Auth::user()->id)->sum('total');
            $condition = '';
        }
        return view('personwork')->with(['works' => $works, 'work_sum' => $work_sum, 'condition' => $condition]);
    }

    public function userwork(Request $request, $userId) //管理者查看個人出勤紀錄
    {
        $user = User::find($userId);
        if ($request->startdate && $request->enddate) {
            $works = Works::where('user_id', $userId)->whereBetween('worktime', [$request->startdate, $request->enddate])->orderBy('id', 'desc')->paginate(15);
            $work_sum = Works::where('user_id', $userId)->whereBetween('worktime', [$request->startdate, $request->enddate])->sum('total');
            $condition = $request->all();
        } else {
            $works = Works::where('user_id', $userId)->orderBy('id', 'desc')->paginate(7);
            $work_sum = Works::where('user_id', $userId)->sum('total');
            $condition = '';
        }
        // $test = Works::work_sum($works->id);
        // dd($test);
        return view('userwork')->with(['works' => $works, 'user' => $user, 'work_sum' => $work_sum, 'condition' => $condition]);
    }
}
