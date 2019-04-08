<?php

use Faker\Generator as Faker;
use App\Models\Follower;

$factory->define(Follower::class, function (Faker $faker) {
    return [
        'account_id' => null,
        'follower_account_id' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
