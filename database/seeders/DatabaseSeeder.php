<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Aleksa Aleksic',
            'email' => 'aleksa@gmail.com'
        ]);

        Category::create(['name' => 'Politics']);
        Category::create(['name' => 'Sport']);
        Category::create(['name' => 'War']);
        Category::create(['name' => 'Money']);

        $categories = Category::all();

        foreach ($categories as $category) {
            News::factory(5)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }

        Tag::create(['name' => 'Economy']);
        Tag::create(['name' => 'Politics']);
        Tag::create(['name' => 'Technology']);
    }
}
