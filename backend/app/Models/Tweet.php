<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}