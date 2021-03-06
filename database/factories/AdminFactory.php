<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    static $password;
    
    return [
        'name' => $faker->name,
        'email' => 'anp@gmail.com',
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10)
    ];
});
