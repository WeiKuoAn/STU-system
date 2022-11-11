<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('user')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'account' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'account' => $request->account,
            'password' => Hash::make($request->password),
            'level' => '2'
        ]);

        return redirect()->route('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId) //管理者
    {
        $user = User::find($userId);
        return view('editUser')->with(['user' => $user]);
    }

    public function showpassword($userId)
    {
        $user = User::find($userId);
        return view('editpassword')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $userId) //管理者
    {
        $user = User::find($userId);

        //軌跡紀錄新增
        $old_name = $user->name;
        $old_account = $user->account;
        $old_email = $user->email;
        $old_level = $user->level;
        $old_mobile = $user->mobile;
        $old_status = $user->status;

        if ($user->level == 0) {
            $user->name = $request->name;
            $user->account = $request->account;
            $user->email = $request->email;
            $user->level = 0;
            $user->mobile = $request->mobile;
            $user->status = 0;
            $user->save();
        } else {
            /*編輯使用者資訊*/
            $user->name = $request->name;
            $user->account = $request->account;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->level = $request->level;
            $user->status = $request->status;
            $user->save();

            /*軌跡紀錄*/
            if ($old_name != $request->name || $old_account != $request->account || $old_email != $request->email || $old_level != $request->level ||  $old_status != $request->status) {
                $user_log = new UserLog;
                $user_log->type = '2';
                $user_log->user_id = $userId;
                $user_log->name = ' ';
                $user_log->Comment = ' ';
                if ($old_name != $request->name) {
                    $user_log->name .= '姓名' . "*";
                    $user_log->Comment .= $old_name . "→" . $request->name . "*";
                }
                if ($old_account != $request->account) {
                    $user_log->name .= '帳號' . "*";
                    $user_log->Comment .= $old_account . "→" . $request->account . "*";
                }
                if ($old_email != $request->email) {
                    $user_log->name .= '信箱' . "*";
                    $user_log->Comment .= $old_email . "→" . $request->email . "*";
                }
                if ($old_mobile != $request->mobile) {
                    $user_log->name .= '電話' . "*";
                    $user_log->Comment .= $old_mobile . "→" . $request->mobile . "*";
                }
                if ($old_level != $request->level) {
                    if ($old_level == '1') {
                        $old_level_str = '管理者';
                    } else if ($old_level == '2') {
                        $old_level_str = '工讀生';
                    }
                    if ($request->level == '1') {
                        $request_level_str = '管理者';
                    } else if ($request->level == '2') {
                        $request_level_str = '工讀生';
                    }
                    $user_log->name .= '等級' . "*";
                    $user_log->Comment .= $old_level_str . "→" . $request_level_str . "*";
                }
                if ($old_status != $request->status) {
                    if ($old_status == '0') {
                        $old_status_str = '開啟';
                    } else if ($old_status == '1') {
                        $old_status_str = '關閉';
                    }
                    if ($request->status == '0') {
                        $request_status_str = '開啟';
                    } else if ($request->status == '1') {
                        $request_status_str = '關閉';
                    }
                    $user_log->name .= '權限' . "*";
                    $user_log->Comment .= $old_status_str . "→" . $request_status_str . "*";
                }
                $user_log->Update_at = Auth::user()->id;
                $user_log->save();
            }
        }
        return redirect()->route('user');
    }

    public function editpassword(Request $request, $userId)
    {
        $user = User::find($userId);
        if ((Hash::check($request->password, $user->password))) {
            if ($request->password_new === $request->password_conf) {
                $user->password = Hash::make($request->password_new);
                $user->save();
                return view('Auth.login');
            }
        } else {
            return view('editpassword')->with(['user' => $user]);
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function personshow($userId) //使用者個人
    {
        $user = User::find($userId);
        return view('person', ['success' => '0'])->with(['user' => $user]);
    }

    public function personedit(Request $request, $userId) //使用者個人
    {
        $user = User::find($userId);

        $old_name = $user->name;
        $old_account = $user->account;
        $old_email = $user->email;
        $old_mobile = $user->mobile;

        $user->name = $request->name;
        $user->account = $request->account;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->save();
        /*編輯使用者資訊*/

        /*軌跡紀錄*/
        if ($old_name != $request->name || $old_account != $request->account || $old_email != $request->email || $old_mobile != $request->mobile) {
            $user_log = new UserLog;
            $user_log->type = '2';
            $user_log->user_id = $userId;
            $user_log->name = ' ';
            $user_log->Comment = ' ';
            if ($old_name != $request->name) {
                $user_log->name .= '姓名' . "*";
                $user_log->Comment .= $old_name . "→" . $request->name . "*";
            }
            if ($old_account != $request->account) {
                $user_log->name .= '帳號' . "*";
                $user_log->Comment .= $old_account . "→" . $request->account . "*";
            }
            if ($old_email != $request->email) {
                $user_log->name .= '信箱' . "*";
                $user_log->Comment .= $old_email . "→" . $request->email . "*";
            }
            if ($old_mobile != $request->mobile) {
                $user_log->name .= '電話' . "*";
                $user_log->Comment .= $old_mobile . "→" . $request->mobile . "*";
            }
            $user_log->Update_at = Auth::user()->id;
            $user_log->save();
        }
        return view('person', ['success' => '1'])->with(['user' => $user]);
    }
}
