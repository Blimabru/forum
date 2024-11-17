<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['reply'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
