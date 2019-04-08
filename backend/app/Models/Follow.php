<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Follow
 *
 * @property int $id
 * @property int $account_id
 * @property int $follow_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow whereFollowAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Follow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Follow extends Model
{

    protected $guarded = [];
}
