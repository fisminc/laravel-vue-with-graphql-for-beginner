<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Follower
 *
 * @property int $id
 * @property int $account_id
 * @property int $follower_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower whereFollowerAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follower whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Follower extends Model
{

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
