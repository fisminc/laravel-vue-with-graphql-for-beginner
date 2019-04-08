<?php

use Faker\Generator as Faker;
use App\Models\Tweet;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'account_id' => function () {
            return factory(\App\Models\Account::class)->create()->id;
        },
        'content' => $faker->text(100),
        'reply_id' => null,
        'tweeted_at' => \Carbon\Carbon::now(),
        'deleted_at' => null,
    ];
});
