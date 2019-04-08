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

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }
    
    public function originalFavorite()
    {
        return $this->belongsTo(Favorite::class, 'original_favorite_id');
    }
}