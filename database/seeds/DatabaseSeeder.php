<?php

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
        DB::insert('insert into users (id, name,email,password) values (?, ?, ?, ?)', [1, 'admin','admin@gmail.com',Hash::make('mohammad')]);
    }
}
