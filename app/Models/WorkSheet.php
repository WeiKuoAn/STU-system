<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WorkSheet extends Model
{
    use HasFactory;

    protected $table = "worksheets";

    protected $fillable = [
        'user_id',
        'title',
        'data_where',
        'contact_person',
        'condition',
        'status',
        'check_user_id'
    ];

    public function over_username(){
        return $this->hasOne('App\Models\User', 'id', 'check_user_id');
    }

    public function create_username(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
