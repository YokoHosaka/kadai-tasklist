<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['content', 'status','user_id']; //すべての追加で定義する可変要素を入れる(ユーザーなどすでに用意されている要素は不要）
    
    public function user()
    {
        return $this->belongsTo(User::class);    
    }
}
