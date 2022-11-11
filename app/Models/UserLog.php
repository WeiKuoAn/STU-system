<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;

class UserLog extends Model
{
    use HasFactory;

    protected $table = "user_logs";

    protected $fillable = [
        'type',
        'name',
        'user_id',
        'comment',
        'update_at',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    public function update_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'update_at');
    }

    public function name()
    {
        $name = $this->name;
        $replace_examples = explode("*",$name);
        // $num = count($replace_example);
        foreach($replace_examples as $replace_example){
            echo $replace_example."<br>";
        }
    }

    public function comment()
    {
        $comment = $this->comment;
        $replace_examples = explode("*",$comment);
        // $num = count($replace_example);
        foreach($replace_examples as $replace_example){
            echo $replace_example."<br>";
        }
    }
}
