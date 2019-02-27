<?php

use Faker\Generator as Faker;
use App\Models\Reply;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'account_id' => null,
        'tweet_id' => null,
        'replied_tweet_id' => null,
        'replied_at' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
