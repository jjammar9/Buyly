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
            ['category_id' => 1, 'name' => 'Organic Bananas', 'slug' => 'organic-bananas', 'price' => 1.49, 'unit' => 'bunch', 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Gala Apples', 'slug' => 'gala-apples', 'price' => 2.99, 'unit' => 'lb', 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Baby Spinach', 'slug' => 'baby-spinach', 'price' => 4.99, 'unit' => '5 oz', 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Avocados', 'slug' => 'avocados', 'price' => 1.99, 'unit' => 'each', 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Strawberries', 'slug' => 'strawberries', 'price' => 3.99, 'unit' => '1 lb'],
            ['category_id' => 1, 'name' => 'Roma Tomatoes', 'slug' => 'roma-tomatoes', 'price' => 1.99, 'unit' => 'lb'],
            ['category_id' => 1, 'name' => 'Red Bell Peppers', 'slug' => 'red-bell-peppers', 'price' => 1.49, 'unit' => 'each'],
            ['category_id' => 1, 'name' => 'Yukon Gold Potatoes', 'slug' => 'yukon-gold-potatoes', 'price' => 4.49, 'unit' => '3 lb'],

            // Meat & Seafood (2)
            ['category_id' => 2, 'name' => 'Boneless Skinless Chicken Breast', 'slug' => 'boneless-skinless-chicken-breast', 'price' => 7.99, 'unit' => 'lb', 'is_featured' => true],
            ['category_id' => 2, 'name' => 'Ground Beef 80/20', 'slug' => 'ground-beef-80-20', 'price' => 5.99, 'unit' => 'lb'],
            ['category_id' => 2, 'name' => 'Atlantic Salmon Fillet', 'slug' => 'atlantic-salmon-fillet', 'price' => 12.99, 'unit' => 'lb', 'is_featured' => true],
            ['category_id' => 2, 'name' => 'Bacon Thick Cut', 'slug' => 'bacon-thick-cut', 'price' => 6.99, 'unit' => '12 oz'],

            // Dairy & Eggs (3)
            ['category_id' => 3, 'name' => 'Whole Milk', 'slug' => 'whole-milk', 'price' => 3.99, 'unit' => 'gallon', 'is_featured' => true],
            ['category_id' => 3, 'name' => 'Large Brown Eggs', 'slug' => 'large-brown-eggs', 'price' => 5.49, 'unit' => '12 ct', 'is_featured' => true],
            ['category_id' => 3, 'name' => 'Unsalted Butter', 'slug' => 'unsalted-butter', 'price' => 4.49, 'unit' => '1 lb'],
            ['category_id' => 3, 'name' => 'Greek Yogurt Plain', 'slug' => 'greek-yogurt-plain', 'price' => 5.99, 'unit' => '32 oz'],

            // Bakery (4)
            ['category_id' => 4, 'name' => 'Sourdough Bread', 'slug' => 'sourdough-bread', 'price' => 4.99, 'unit' => 'each', 'is_featured' => true],
            ['category_id' => 4, 'name' => 'Croissants 4-Pack', 'slug' => 'croissants-4-pack', 'price' => 5.49, 'unit' => '4 ct'],
            ['category_id' => 4, 'name' => 'Chocolate Chip Cookies', 'slug' => 'chocolate-chip-cookies', 'price' => 3.99, 'unit' => '12 ct'],

            // Beverages (5)
            ['category_id' => 5, 'name' => 'Cold Brew Coffee', 'slug' => 'cold-brew-coffee', 'price' => 4.99, 'unit' => '32 oz'],
            ['category_id' => 5, 'name' => 'Orange Juice', 'slug' => 'orange-juice', 'price' => 4.49, 'unit' => '52 oz'],
            ['category_id' => 5, 'name' => 'Sparkling Water Variety Pack', 'slug' => 'sparkling-water-variety-pack', 'price' => 5.99, 'unit' => '12 ct'],

            // Snacks (6)
            ['category_id' => 6, 'name' => 'Almonds Roasted Unsalted', 'slug' => 'almonds-roasted-unsalted', 'price' => 7.99, 'unit' => '16 oz'],
            ['category_id' => 6, 'name' => 'Dark Chocolate Bar', 'slug' => 'dark-chocolate-bar', 'price' => 3.49, 'unit' => '3.5 oz'],
            ['category_id' => 6, 'name' => 'Tortilla Chips', 'slug' => 'tortilla-chips', 'price' => 4.29, 'unit' => '13 oz'],

            // Frozen (7)
            ['category_id' => 7, 'name' => 'Frozen Mixed Berries', 'slug' => 'frozen-mixed-berries', 'price' => 5.99, 'unit' => '48 oz'],
            ['category_id' => 7, 'name' => 'Vanilla Bean Ice Cream', 'slug' => 'vanilla-bean-ice-cream', 'price' => 6.49, 'unit' => '1.5 qt'],
            ['category_id' => 7, 'name' => 'Frozen Pizza', 'slug' => 'frozen-pizza', 'price' => 8.99, 'unit' => 'each'],

            // Pantry Staples (8)
            ['category_id' => 8, 'name' => 'Extra Virgin Olive Oil', 'slug' => 'extra-virgin-olive-oil', 'price' => 11.99, 'unit' => '25.4 oz'],
            ['category_id' => 8, 'name' => 'Basmati Rice', 'slug' => 'basmati-rice', 'price' => 9.99, 'unit' => '5 lb'],
            ['category_id' => 8, 'name' => 'Pasta Spaghetti', 'slug' => 'pasta-spaghetti', 'price' => 1.99, 'unit' => '16 oz'],

            // Household (9)
            ['category_id' => 9, 'name' => 'Paper Towels 6-Pack', 'slug' => 'paper-towels-6-pack', 'price' => 8.99, 'unit' => '6 ct'],
            ['category_id' => 9, 'name' => 'Dish Soap', 'slug' => 'dish-soap', 'price' => 3.99, 'unit' => '14 oz'],

            // Personal Care (10)
            ['category_id' => 10, 'name' => 'Hand Soap Refill', 'slug' => 'hand-soap-refill', 'price' => 4.49, 'unit' => '33 oz'],
            ['category_id' => 10, 'name' => 'Toothpaste', 'slug' => 'toothpaste', 'price' => 5.49, 'unit' => '4.7 oz'],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
