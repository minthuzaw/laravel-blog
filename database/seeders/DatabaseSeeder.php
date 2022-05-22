<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::truncate();
//        Post::truncate();
//        Category::truncate();

        Post::factory(5)->create();

         \App\Models\User::factory(3)->create();
//         Category::create([
//             'name'=>'Personal',
//             'slug'=>'personal'
//         ]);
//         Category::create([
//             'name'=>'Work',
//             'slug'=>'work'
//         ]);
//         Category::create([
//             'name'=>'Family',
//             'slug'=>'family'
//         ]);
    }
}
