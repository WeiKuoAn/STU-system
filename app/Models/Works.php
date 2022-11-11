<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Works extends Model
{
    use HasFactory;

    protected $table = "works";
    static private $works  = "Works";

    protected $fillable = [
        'user_id',
        'worktime',
        'dutytime',
        'status',
        'remark',
    ];

    public static  function work_sum($workId)
    {
        $work = self::where('id',$workId)->first();
        $num = '';
        $work_num = Carbon::parse($work->worktime)->floatDiffInHours($work->dutytime);
        $format_work_num = number_format($work_num, 2);
        $strval_work_num = strval($format_work_num);
        $explode_work_num = preg_split('//', $strval_work_num, -1, PREG_SPLIT_NO_EMPTY);
        if ($explode_work_num[2] >= '5') {
            $num = $explode_work_num[0] . $explode_work_num[1] . '5';
        } else {
            $num = ceil($explode_work_num[0] . $explode_work_num[1] . '0');
        }
        return $num;
    }

    public function work_total($userId)
    {
        $num = '';
        $work_num = Carbon::parse($this->worktime)->floatDiffInHours($this->dutytime);
        $format_work_num = number_format($work_num, 2);
        $strval_work_num = strval($format_work_num);
        $explode_work_num = preg_split('//', $strval_work_num, -1, PREG_SPLIT_NO_EMPTY);
        if ($explode_work_num[2] >= '5') {
            $num = $explode_work_num[0] . $explode_work_num[1] . '5';
        } else {
            $num = ceil($explode_work_num[0] . $explode_work_num[1] . '0');
        }
        return $num;
    }
}
