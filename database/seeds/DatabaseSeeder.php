<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);


        // factory(\App\User::class,10)->create();
        // factory(\App\Post::class,20)->create();
        DB::insert('insert into users (id, name,email,password) values (?,?,?,?)', [11, 'admin','admin@gmail.com',Hash::make('mohammad')]);
    }
}
