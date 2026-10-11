<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nike Air Zoom Pegasus',
                'description' => 'Giày chạy bộ nhẹ, êm, phù hợp tập luyện hàng ngày.',
                'price' => 2500000,
                'category_id' => 2,
            ],
            [
                'name' => 'Adidas Ultraboost',
                'description' => 'Giày chạy cao cấp với đệm êm và độ đàn hồi tốt.',
                'price' => 3200000,
                'category_id' => 2,
            ],
            [
                'name' => 'Converse Chuck Taylor',
                'description' => 'Mẫu sneaker cổ điển phù hợp đi chơi.',
                'price' => 1500000,
                'category_id' => 3,
            ],
            [
                'name' => 'Vans Old Skool',
                'description' => 'Sneaker phong cách trẻ trung, dễ phối đồ.',
                'price' => 1800000,
                'category_id' => 3,
            ],
            [
                'name' => 'Puma Sport X',
                'description' => 'Giày thể thao đa năng, dùng cho vận động nhẹ.',
                'price' => 2100000,
                'category_id' => 1,
            ],
            [
                'name' => 'Dép Adidas Adilette',
                'description' => 'Dép đi trong nhà và ngoài trời tiện lợi.',
                'price' => 850000,
                'category_id' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}