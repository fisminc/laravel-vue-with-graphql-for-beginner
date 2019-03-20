<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tweet
 *
 * @property int $id
 * @property int $account_id
 * @property string $content
 * @property int|null $reply_id
 * @property string $tweeted_at
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retweet[] $retweets
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tweet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereReplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereTweetedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tweet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tweet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tweet withoutTrashed()
 * @mixin \Eloquent
 */
class Tweet extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    public function myRetweet()
    {
        if (!auth()->user()) {
            return null;
        }

        return $this->hasOne(Retweet::class)
                    ->where('account_id', auth()->user()->id);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
