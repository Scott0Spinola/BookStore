<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$books = DB::table('books')->get();
$imagesPath = storage_path('app/public/images');

// Make sure images directory exists
if (!file_exists($imagesPath)) {
    mkdir($imagesPath, 0755, true);
}

foreach ($books as $book) {
    $imagePath = storage_path('app/public/' . $book->image);
    
    // Skip if image already exists
    if (file_exists($imagePath)) {
        echo "Image exists for: {$book->title}\n";
        continue;
    }
    
    // Create a simple placeholder image
    $width = 400;
    $height = 600;
    $image = imagecreatetruecolor($width, $height);
    
    // Random background color
    $bgColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
    imagefill($image, 0, 0, $bgColor);
    
    // White text
    $textColor = imagecolorallocate($image, 255, 255, 255);
    
    // Add book title (simplified)
    $text = substr($book->title, 0, 20);
    imagestring($image, 5, 10, $height/2 - 10, $text, $textColor);
    
    // Add price
    $priceText = '$' . number_format($book->price, 2);
    imagestring($image, 4, 10, $height/2 + 20, $priceText, $textColor);
    
    // Save image
    $extension = pathinfo($book->image, PATHINFO_EXTENSION);
    if ($extension === 'png') {
        imagepng($image, $imagePath);
    } else {
        imagejpeg($image, $imagePath, 90);
    }
    
    imagedestroy($image);
    echo "Created placeholder for: {$book->title} at {$imagePath}\n";
}

echo "\nDone! All placeholder images created.\n";
