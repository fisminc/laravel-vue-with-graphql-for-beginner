<?php

use Faker\Generator as Faker;
use App\Models\Follow;

$factory->define(Follow::class, function (Faker $faker) {
    return [
        'account_id' => null,
        'follow_account_id' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
