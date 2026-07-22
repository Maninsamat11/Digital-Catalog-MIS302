<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$dir = __DIR__ . '/storage/app/public/products';
$quality = 90;
$converted = 0;

foreach (glob($dir . '/*.webp') as $webpPath) {
    $jpgPath = preg_replace('/\.webp$/i', '.jpg', $webpPath);

    $image = @imagecreatefromwebp($webpPath);
    if ($image === false) {
        echo "Skip (read failed): $webpPath\n";
        continue;
    }

    $width = imagesx($image);
    $height = imagesy($image);
    $jpg = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($jpg, 255, 255, 255);
    imagefill($jpg, 0, 0, $white);
    imagecopy($jpg, $image, 0, 0, 0, 0, $width, $height);

    if (!imagejpeg($jpg, $jpgPath, $quality)) {
        echo "Fail (save): $webpPath\n";
        imagedestroy($image);
        imagedestroy($jpg);
        continue;
    }

    imagedestroy($image);
    imagedestroy($jpg);
    unlink($webpPath);

    echo "Converted: " . basename($webpPath) . " -> " . basename($jpgPath) . "\n";
    $converted++;
}

$updated = App\Models\Product::where('product_image', 'like', '%.webp')
    ->get()
    ->each(function ($product) {
        $product->update([
            'product_image' => preg_replace('/\.webp$/i', '.jpg', $product->product_image),
        ]);
        echo "DB updated product #{$product->id}: {$product->product_image}\n";
    })
    ->count();

echo "\nDone. Converted {$converted} file(s), updated {$updated} product record(s).\n";
