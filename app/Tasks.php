<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //使用taskss表
    protected $table = 'taskss';
    //允许批量复制
    protected $fillable = ['name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
