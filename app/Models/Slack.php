<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slack extends Model
{
    /** @use HasFactory<\Database\Factories\SlackFactory> */
    use HasFactory;
    protected $fillable = ['slack_id', 'slack_text', 'slack_ts'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

}
