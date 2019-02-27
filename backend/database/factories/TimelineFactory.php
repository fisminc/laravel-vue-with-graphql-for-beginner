<?php

use Faker\Generator as Faker;
use App\Models\Timeline;

$factory->define(Timeline::class, function (Faker $faker) {
    return [
        'account_id' => function () {
            return factory(\App\Models\Account::class)->create()->id;
        },
        'tweet_id' => function () {
            return factory(\App\Models\Tweet::class)->create()->id;
        },
        'favorite_id' => function () {
            return factory(\App\Models\Favorite::class)->create()->id;
        },
    ];
});
