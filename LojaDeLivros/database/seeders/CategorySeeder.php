<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Fiction']);
        Category::create(['name' => 'Romance']);
        Category::create(['name' => 'Science Fiction']);
        Category::create(['name' => 'Comics']);
    }
}
