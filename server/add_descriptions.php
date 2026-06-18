<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

$descs = [
    'organic-bananas' => 'Perfectly ripe organic bananas, grown without synthetic pesticides.',
    'gala-apples' => 'Crisp and sweet Gala apples, picked at peak ripeness.',
    'baby-spinach' => 'Tender baby spinach leaves, triple-washed and ready to eat.',
    'avocados' => 'Rich and creamy Hass avocados, sourced from sustainable farms.',
    'strawberries' => 'Juicy, sun-ripened strawberries bursting with flavor.',
    'roma-tomatoes' => 'Firm, meaty Roma tomatoes with rich flavor.',
    'red-bell-peppers' => 'Sweet and crunchy red bell peppers, packed with vitamin C.',
    'yukon-gold-potatoes' => 'Buttery Yukon Gold potatoes with thin golden skin.',
    'boneless-skinless-chicken-breast' => 'Lean boneless chicken breasts, perfect for grilling or baking.',
    'ground-beef-80-20' => 'Premium ground beef with the perfect meat-to-fat ratio.',
    'atlantic-salmon-fillet' => 'Fresh Atlantic salmon fillet, rich in omega-3 fatty acids.',
    'bacon-thick-cut' => 'Smoky thick-cut bacon, cured to perfection.',
    'whole-milk' => 'Farm-fresh whole milk, rich and creamy.',
    'large-brown-eggs' => 'Cage-free large brown eggs from pasture-raised hens.',
    'unsalted-butter' => 'Creamery butter made from fresh sweet cream.',
    'greek-yogurt-plain' => 'Thick and creamy plain Greek yogurt, perfect for breakfast.',
    'sourdough-bread' => 'Artisan sourdough bread with a crispy crust and tangy flavor.',
    'croissants-4-pack' => 'Flaky, buttery croissants baked fresh daily.',
    'chocolate-chip-cookies' => 'Soft-baked chocolate chip cookies with real butter.',
    'cold-brew-coffee' => 'Smooth cold brew coffee, slow-steeped for 20 hours.',
    'orange-juice' => 'Fresh-squeezed orange juice, never from concentrate.',
    'sparkling-water-variety-pack' => 'Refreshing sparkling water in assorted fruit flavors.',
    'almonds-roasted-unsalted' => 'Crunchy roasted almonds with no added salt.',
    'dark-chocolate-bar' => 'Rich dark chocolate, made with 70% cacao.',
    'tortilla-chips' => 'Crispy corn tortilla chips, perfect for dipping.',
    'frozen-mixed-berries' => 'A blend of strawberries, blueberries, and raspberries.',
    'vanilla-bean-ice-cream' => 'Creamy vanilla bean ice cream made with real vanilla.',
    'frozen-pizza' => 'Classic cheese pizza with a crispy thin crust.',
    'extra-virgin-olive-oil' => 'Cold-pressed extra virgin olive oil from Italy.',
    'basmati-rice' => 'Aromatic long-grain basmati rice, perfect for pilafs.',
    'pasta-spaghetti' => 'Premium durum wheat spaghetti, cooks al dente.',
    'paper-towels-6-pack' => 'Absorbent paper towels, 2-ply strength.',
    'dish-soap' => 'Grease-fighting dish soap with a fresh lemon scent.',
    'hand-soap-refill' => 'Gentle hand soap refill with moisturizing aloe.',
    'toothpaste' => 'Fluoride toothpaste for cavity protection and fresh breath.',
];

$count = 0;
foreach ($descs as $slug => $desc) {
    Product::where('slug', $slug)->update(['description' => $desc]);
    $count++;
}
echo "Done: $count products updated.\n";
