<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Fruits & Vegetables (1)
            ['category_id' => 1, 'name' => 'Organic Bananas', 'slug' => 'organic-bananas', 'price' => 1.49, 'unit' => 'bunch', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Gala Apples', 'slug' => 'gala-apples', 'price' => 2.99, 'unit' => 'lb', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Baby Spinach', 'slug' => 'baby-spinach', 'price' => 4.99, 'unit' => '5 oz', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Avocados', 'slug' => 'avocados', 'price' => 1.99, 'unit' => 'each', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Strawberries', 'slug' => 'strawberries', 'price' => 3.99, 'unit' => '1 lb', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Roma Tomatoes', 'slug' => 'roma-tomatoes', 'price' => 1.99, 'unit' => 'lb', 'image' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Red Bell Peppers', 'slug' => 'red-bell-peppers', 'price' => 1.49, 'unit' => 'each', 'image' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop'],
            ['category_id' => 1, 'name' => 'Yukon Gold Potatoes', 'slug' => 'yukon-gold-potatoes', 'price' => 4.49, 'unit' => '3 lb', 'image' => 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop'],

            // Meat & Seafood (2)
            ['category_id' => 2, 'name' => 'Boneless Skinless Chicken Breast', 'slug' => 'boneless-skinless-chicken-breast', 'price' => 7.99, 'unit' => 'lb', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1607330289024-1535c6b4e1c1?w=400&h=400&fit=crop'],
            ['category_id' => 2, 'name' => 'Ground Beef 80/20', 'slug' => 'ground-beef-80-20', 'price' => 5.99, 'unit' => 'lb', 'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop'],
            ['category_id' => 2, 'name' => 'Atlantic Salmon Fillet', 'slug' => 'atlantic-salmon-fillet', 'price' => 12.99, 'unit' => 'lb', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=400&h=400&fit=crop'],
            ['category_id' => 2, 'name' => 'Bacon Thick Cut', 'slug' => 'bacon-thick-cut', 'price' => 6.99, 'unit' => '12 oz', 'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop'],

            // Dairy & Eggs (3)
            ['category_id' => 3, 'name' => 'Whole Milk', 'slug' => 'whole-milk', 'price' => 3.99, 'unit' => 'gallon', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop'],
            ['category_id' => 3, 'name' => 'Large Brown Eggs', 'slug' => 'large-brown-eggs', 'price' => 5.49, 'unit' => '12 ct', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=400&h=400&fit=crop'],
            ['category_id' => 3, 'name' => 'Unsalted Butter', 'slug' => 'unsalted-butter', 'price' => 4.49, 'unit' => '1 lb', 'image' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400&h=400&fit=crop'],
            ['category_id' => 3, 'name' => 'Greek Yogurt Plain', 'slug' => 'greek-yogurt-plain', 'price' => 5.99, 'unit' => '32 oz', 'image' => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop'],

            // Bakery (4)
            ['category_id' => 4, 'name' => 'Sourdough Bread', 'slug' => 'sourdough-bread', 'price' => 4.99, 'unit' => 'each', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop'],
            ['category_id' => 4, 'name' => 'Croissants 4-Pack', 'slug' => 'croissants-4-pack', 'price' => 5.49, 'unit' => '4 ct', 'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop'],
            ['category_id' => 4, 'name' => 'Chocolate Chip Cookies', 'slug' => 'chocolate-chip-cookies', 'price' => 3.99, 'unit' => '12 ct', 'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=400&fit=crop'],

            // Beverages (5)
            ['category_id' => 5, 'name' => 'Cold Brew Coffee', 'slug' => 'cold-brew-coffee', 'price' => 4.99, 'unit' => '32 oz', 'image' => 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop'],
            ['category_id' => 5, 'name' => 'Orange Juice', 'slug' => 'orange-juice', 'price' => 4.49, 'unit' => '52 oz', 'image' => 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop'],
            ['category_id' => 5, 'name' => 'Sparkling Water Variety Pack', 'slug' => 'sparkling-water-variety-pack', 'price' => 5.99, 'unit' => '12 ct', 'image' => 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop'],

            // Snacks (6)
            ['category_id' => 6, 'name' => 'Almonds Roasted Unsalted', 'slug' => 'almonds-roasted-unsalted', 'price' => 7.99, 'unit' => '16 oz', 'image' => 'https://images.unsplash.com/photo-1526367790999-0150786686a2?w=400&h=400&fit=crop'],
            ['category_id' => 6, 'name' => 'Dark Chocolate Bar', 'slug' => 'dark-chocolate-bar', 'price' => 3.49, 'unit' => '3.5 oz', 'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=400&fit=crop'],
            ['category_id' => 6, 'name' => 'Tortilla Chips', 'slug' => 'tortilla-chips', 'price' => 4.29, 'unit' => '13 oz', 'image' => 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop'],

            // Frozen (7)
            ['category_id' => 7, 'name' => 'Frozen Mixed Berries', 'slug' => 'frozen-mixed-berries', 'price' => 5.99, 'unit' => '48 oz', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop'],
            ['category_id' => 7, 'name' => 'Vanilla Bean Ice Cream', 'slug' => 'vanilla-bean-ice-cream', 'price' => 6.49, 'unit' => '1.5 qt', 'image' => 'https://images.unsplash.com/photo-1631214524020-7e18db9a8f92?w=400&h=400&fit=crop'],
            ['category_id' => 7, 'name' => 'Frozen Pizza', 'slug' => 'frozen-pizza', 'price' => 8.99, 'unit' => 'each', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop'],

            // Pantry Staples (8)
            ['category_id' => 8, 'name' => 'Extra Virgin Olive Oil', 'slug' => 'extra-virgin-olive-oil', 'price' => 11.99, 'unit' => '25.4 oz', 'image' => 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop'],
            ['category_id' => 8, 'name' => 'Basmati Rice', 'slug' => 'basmati-rice', 'price' => 9.99, 'unit' => '5 lb', 'image' => 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop'],
            ['category_id' => 8, 'name' => 'Pasta Spaghetti', 'slug' => 'pasta-spaghetti', 'price' => 1.99, 'unit' => '16 oz', 'image' => 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop'],

            // Household (9)
            ['category_id' => 9, 'name' => 'Paper Towels 6-Pack', 'slug' => 'paper-towels-6-pack', 'price' => 8.99, 'unit' => '6 ct', 'image' => 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop'],
            ['category_id' => 9, 'name' => 'Dish Soap', 'slug' => 'dish-soap', 'price' => 3.99, 'unit' => '14 oz', 'image' => 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop'],

            // Personal Care (10)
            ['category_id' => 10, 'name' => 'Hand Soap Refill', 'slug' => 'hand-soap-refill', 'price' => 4.49, 'unit' => '33 oz', 'image' => 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop'],
            ['category_id' => 10, 'name' => 'Toothpaste', 'slug' => 'toothpaste', 'price' => 5.49, 'unit' => '4.7 oz', 'image' => 'https://images.unsplash.com/photo-1598387993441-a364f854c3e1?w=400&h=400&fit=crop'],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
