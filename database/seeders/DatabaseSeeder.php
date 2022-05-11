<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Spencer Heffley',
            'email' => 'spheffley@icloud.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'admin' => true,
        ]);
    }
}
