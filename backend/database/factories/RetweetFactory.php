<?php

use Faker\Generator as Faker;
use App\Models\Retweet;

$factory->define(Retweet::class, function (Faker $faker) {
    return [
        'account_id' => null,
        'tweet_id' => null,
        'original_tweet_id' => null,
        'retweeted_at' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
