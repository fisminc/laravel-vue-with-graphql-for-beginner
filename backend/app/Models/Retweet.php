<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Retweet
 *
 * @property int $id
 * @property int $account_id
 * @property int $tweet_id
 * @property string $retweeted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereRetweetedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $original_tweet_id
 * @property-read \App\Models\Tweet $originalTweet
 * @property-read \App\Models\Tweet $tweet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Retweet whereOriginalTweetId($value)
 */
class Retweet extends Model
{

    protected $guarded = [];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    public function originalTweet()
    {
        return $this->belongsTo(Tweet::class, 'original_tweet_id');
    }
}
