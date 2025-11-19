<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Fix image paths that have /storage/ prefix
$books = DB::table('books')->get();

foreach ($books as $book) {
    $newImage = $book->image;
    
    // Remove /storage/ prefix if it exists
    if (str_starts_with($newImage, '/storage/')) {
        $newImage = str_replace('/storage/', '', $newImage);
    }
    
    // Remove storage/ prefix if it exists
    if (str_starts_with($newImage, 'storage/')) {
        $newImage = str_replace('storage/', '', $newImage);
    }
    
    if ($newImage !== $book->image) {
        DB::table('books')->where('id', $book->id)->update(['image' => $newImage]);
        echo "Updated book {$book->id}: {$book->image} -> {$newImage}\n";
    }
}

echo "Done!\n";
