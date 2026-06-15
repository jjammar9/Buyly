<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'sort_order' => 1],
            ['name' => 'Meat & Seafood', 'slug' => 'meat-seafood', 'sort_order' => 2],
            ['name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'sort_order' => 3],
            ['name' => 'Bakery', 'slug' => 'bakery', 'sort_order' => 4],
            ['name' => 'Beverages', 'slug' => 'beverages', 'sort_order' => 5],
            ['name' => 'Snacks', 'slug' => 'snacks', 'sort_order' => 6],
            ['name' => 'Frozen', 'slug' => 'frozen', 'sort_order' => 7],
            ['name' => 'Pantry Staples', 'slug' => 'pantry-staples', 'sort_order' => 8],
            ['name' => 'Household', 'slug' => 'household', 'sort_order' => 9],
            ['name' => 'Personal Care', 'slug' => 'personal-care', 'sort_order' => 10],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
