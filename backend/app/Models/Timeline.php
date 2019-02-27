<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Timeline
 *
 * @property int $id
 * @property int $account_id
 * @property int $tweet_id
 * @property int|null $favorite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereFavoriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Tweet $tweet
 * @property-read \App\Models\Favorite|null $favorite
 */
class Timeline extends Model
{
    protected $guarded = [];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }
}
