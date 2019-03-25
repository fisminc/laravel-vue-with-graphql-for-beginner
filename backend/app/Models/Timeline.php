<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
}