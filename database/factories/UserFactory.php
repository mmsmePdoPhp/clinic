<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// delete all users and posts
foreach (User::all() as $key => $user) {
    foreach ($user->posts as $key => $post) {
        $post->delete();
    }
    $user->delete();
}


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Post::class, function ($faker) use ($factory) {
    return [
        'title' => $faker->sentence(3),
        'content' => $faker->paragraph(5),
        'user_id' => User::pluck('id')[$faker->numberBetween(1,User::count()-1)]
    ];
});
