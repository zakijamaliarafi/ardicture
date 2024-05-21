<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin 1',
            'username' => 'admin1',
            'password' => Hash::make('1234'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Admin 2',
            'username' => 'admin2',
            'password' => Hash::make('1234'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Admin 3',
            'username' => 'admin3',
            'password' => Hash::make('1234'),
            'role' => 'admin'
        ]);

        Post::factory(15)->create();
        Image::factory(15)->create();
    }
}
