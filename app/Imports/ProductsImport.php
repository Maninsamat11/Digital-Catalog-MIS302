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
        // Find the category by name (e.g., "Keyboards") or default to 1
        $category = Category::where('category_name', $row['category'])->first();

        return new Product([
            'category_id'    => $category ? $category->id : 1, 
            'product_name'   => $row['name'],
            'brand'          => $row['brand'],
            'description'    => $row['description'],
            'price'          => $row['price'],
            'stock_quantity' => $row['stock'],
            'status'         => 'available',
            'product_image'  => 'products/placeholder.jpg', // You can update images manually later
        ]);
    }
}