<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

// foreach (Post::all() as $key => $post) {
//     $post->delete();
// }

// $userCount  = User::pluck('id')->count();
// $factory->define(Post::class, function (Faker $faker) use($userCount) {
//     return [
//         'title' => $faker->sentence(3),
//         'content' => $faker->paragraph(5),
//         'user_id'=> (User::pluck('id')[$faker->numberBetween(0,($userCount-1))])
//     ];
// });
