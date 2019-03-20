<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Timeline
 *
 * @property int $id
 * @property int $account_id
 * @property int $tweet_id
 * @property int|null $favorite_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Favorite|null $favorite
 * @property-read \App\Models\Tweet $tweet
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Timeline onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereFavoriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Timeline withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Timeline withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $original_favorite_id
 * @property int|null $original_retweet_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereOriginalFavoriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Timeline whereOriginalRetweetId($value)
 */
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
