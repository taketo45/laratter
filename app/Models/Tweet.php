<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;

    protected $fillable = ['tweet']; //ユーザーが自由に入れられるカラムという宣言

    // 下の書き方もある。どちらか一方でOK
    // protected $guarded = ['id','user_id','created_at', 'updated_at']; //ユーザーが自由に入れられないカラムという宣言

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
