<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
