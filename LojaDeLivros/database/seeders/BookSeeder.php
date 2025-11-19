<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'The Hitchhiker\'s Guide to the Galaxy',
            'author' => 'Douglas Adams',
            'description' => 'A hilarious science fiction adventure.',
            'price' => 12.99,
            'image' => 'images/hitchhikers.jpg',
            'category_id' => 3,
            'owner_id' => 1,
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'description' => 'A classic romance novel.',
            'price' => 9.99,
            'image' => 'images/pride.jpg',
            'category_id' => 2,
            'owner_id' => 1,
        ]);

        Book::create([
            'title' => 'The Sandman',
            'author' => 'Neil Gaiman',
            'description' => 'A dark and brilliant comic series.',
            'price' => 19.99,
            'image' => 'images/sandman.jpg',
            'category_id' => 4,
            'owner_id' => 1,
        ]);
    }
}
