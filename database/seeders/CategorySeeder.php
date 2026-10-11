<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Giày thể thao',
                'description' => 'Các loại giày thể thao nam nữ'
            ],
            [
                'name' => 'Giày chạy bộ',
                'description' => 'Giày chuyên dùng để chạy bộ'
            ],
            [
                'name' => 'Giày sneaker',
                'description' => 'Các mẫu sneaker thời trang'
            ],
            [
                'name' => 'Dép',
                'description' => 'Dép mang hàng ngày'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}