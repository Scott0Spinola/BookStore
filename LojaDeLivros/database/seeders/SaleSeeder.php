<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

     
        $users->each(function ($user) use ($books) {
           
            $purchaseCount = rand(1, 5);
            $selectedBooks = $books->random(min($purchaseCount, $books->count()));

            foreach ($selectedBooks as $book) {
                Sale::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'sale_date' => now()->subDays(rand(0, 365)),
                ]);
            }
        });
    }
}
