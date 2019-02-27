<?php

use Faker\Generator as Faker;
use App\Models\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'twitter_id' => null,
        'name' => null,
        'email' => null,
        'avatar' => null,
        'email_verified_at' => null,
        'password' => null,
        'remember_token' => null,
        'logged_in_at' => null,
        'signed_up_at' => null,
        'created_at' => null,
        'updated_at' => null,
    ];
});
