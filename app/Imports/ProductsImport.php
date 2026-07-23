<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Find the category by name (e.g., if Excel says 'Speakers', find ID 14)
        $category = Category::where('category_name', $row['category'])->first();

        return new Product([
            'product_name'   => $row['name'],
            'brand'          => $row['brand'],
            'category_id'    => $category ? $category->id : 1, // Default to ID 1 if not found
            'price'          => $row['price'],
            'stock_quantity' => $row['stock'],
            'description'    => $row['description'],
            'product_image'  => $row['image'], // Should be 'products/0ClR82.jpg' or a URL
            'status'         => $row['stock'] > 0 ? 'available' : 'out_of_stock',
        ]);
    }
}