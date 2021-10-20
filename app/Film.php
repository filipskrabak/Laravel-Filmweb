<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function cats()
    {
        return $this->belongsToMany(Cat::class);
    }
    public function featured()
    {
        return $this->hasOne(Featured::class);
    }
}
