<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'slug'];

    protected static function boot()
{
    parent::boot();

    // Evento ao criar uma nova thread
    static::creating(function ($thread) {
        if (empty($thread->slug)) {
            $thread->slug = \Illuminate\Support\Str::slug($thread->title);
        }
    });

    // Evento ao atualizar uma thread
    static::updating(function ($thread) {
        if ($thread->isDirty('title')) {
            $thread->slug = \Illuminate\Support\Str::slug($thread->title);
        }
    });
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
