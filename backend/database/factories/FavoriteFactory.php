<?php

use Faker\Generator as Faker;
use App\Models\Favorite;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'account_id' => null,
        'tweet_id' => null,
        'favorite_at' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
