INSERT INTO categories (name, slug) VALUES
  ('Fruits & Vegetables', 'fruits-vegetables'),
  ('Meat & Seafood', 'meat-seafood'),
  ('Dairy & Eggs', 'dairy-eggs'),
  ('Bakery', 'bakery'),
  ('Beverages', 'beverages'),
  ('Snacks', 'snacks'),
  ('Frozen', 'frozen'),
  ('Pantry Staples', 'pantry-staples'),
  ('Household', 'household'),
  ('Personal Care', 'personal-care');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (1, 'Organic Bananas', 'organic-bananas', 1.49, 'bunch', 'https://images.unsplash.com/photo-1570913149827-d2ac84ab3f9a?w=400&h=400&fit=crop', 'Perfectly ripe organic bananas, grown without synthetic pesticides. A great source of potassium and natural energy.'),
  (1, 'Gala Apples', 'gala-apples', 2.99, 'lb', 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop', 'Crisp and sweet Gala apples, picked at peak ripeness.'),
  (1, 'Baby Spinach', 'baby-spinach', 4.99, '5 oz', 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400&h=400&fit=crop', 'Tender baby spinach leaves, triple-washed and ready to eat.'),
  (1, 'Avocados', 'avocados', 1.99, 'each', 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=400&fit=crop', 'Rich and creamy Hass avocados, sourced from sustainable farms.'),
  (1, 'Strawberries', 'strawberries', 3.99, '1 lb', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', 'Juicy, sun-ripened strawberries bursting with flavor.'),
  (1, 'Roma Tomatoes', 'roma-tomatoes', 1.99, 'lb', 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop', 'Firm, meaty Roma tomatoes with rich flavor.'),
  (1, 'Red Bell Peppers', 'red-bell-peppers', 1.49, 'each', 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=400&h=400&fit=crop', 'Sweet and crunchy red bell peppers, packed with vitamin C.'),
  (1, 'Yukon Gold Potatoes', 'yukon-gold-potatoes', 4.49, '3 lb', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', 'Buttery Yukon Gold potatoes with thin golden skin.'),
  (1, 'Fresh Blueberries', 'fresh-blueberries', 4.99, '6 oz', 'https://images.unsplash.com/photo-1498557850523-fd3d118b962e?w=400&h=400&fit=crop', 'Plump, sweet blueberries packed with antioxidants.'),
  (1, 'English Cucumber', 'english-cucumber', 2.49, 'each', 'https://images.unsplash.com/photo-1604977042946-1eecc30f269e?w=400&h=400&fit=crop', 'Long, seedless English cucumbers with thin skin.'),
  (1, 'Broccoli Crowns', 'broccoli-crowns', 2.99, 'lb', 'https://images.unsplash.com/photo-1459411621453-7b03977f4bfc?w=400&h=400&fit=crop', 'Fresh broccoli crowns with tight florets.'),
  (1, 'Baby Carrots', 'baby-carrots', 2.49, '1 lb', 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=400&h=400&fit=crop', 'Sweet, tender baby carrots pre-peeled and ready to eat.'),
  (1, 'Green Grapes', 'green-grapes', 3.99, 'lb', 'https://images.unsplash.com/photo-1560807707-8cc77767d783?w=400&h=400&fit=crop', 'Seedless green grapes, crisp and burstingly sweet.'),
  (1, 'Lemons', 'lemons', 0.79, 'each', 'https://images.unsplash.com/photo-1580537659466-a9b5d7288a1a?w=400&h=400&fit=crop', 'Bright, juicy lemons bursting with citrus flavor.'),
  (1, 'Fresh Herbs Basil', 'fresh-herbs-basil', 2.99, '0.75 oz', 'https://images.unsplash.com/photo-1561144257-e32e8efc6c4f?w=400&h=400&fit=crop', 'Aromatic fresh basil leaves.'),
  (1, 'Sweet Potatoes', 'sweet-potatoes', 1.49, 'lb', 'https://images.unsplash.com/photo-1596097635121-14b963b0fa1b?w=400&h=400&fit=crop', 'Rich, orange-fleshed sweet potatoes loaded with beta-carotene.'),
  (1, 'Cauliflower', 'cauliflower', 3.49, 'head', 'https://images.unsplash.com/photo-1568584711077-3d021a7ee3f9?w=400&h=400&fit=crop', 'Fresh, dense cauliflower heads.'),
  (1, 'White Onions', 'white-onions', 1.29, 'lb', 'https://images.unsplash.com/photo-1595956548611-0c7960d2a93c?w=400&h=400&fit=crop', 'Sharp, pungent white onions.'),
  (1, 'Fresh Mangoes', 'fresh-mangoes', 1.99, 'each', 'https://images.unsplash.com/photo-1560807707-8cc77767d783?w=400&h=400&fit=crop', 'Sweet, juicy mangoes with vibrant golden flesh.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (2, 'Boneless Skinless Chicken Breast', 'boneless-skinless-chicken-breast', 7.99, 'lb', 'https://images.unsplash.com/photo-1607330289024-1535c6b4e1c1?w=400&h=400&fit=crop', ''),
  (2, 'Ground Beef 80/20', 'ground-beef-80-20', 5.99, 'lb', 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop', ''),
  (2, 'Atlantic Salmon Fillet', 'atlantic-salmon-fillet', 12.99, 'lb', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=400&h=400&fit=crop', ''),
  (2, 'Bacon Thick Cut', 'bacon-thick-cut', 6.99, '12 oz', 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop', ''),
  (2, 'Pork Chops Bone-In', 'pork-chops-bone-in', 6.49, 'lb', 'https://images.unsplash.com/photo-1602470520998-f4a52199a3d6?w=400&h=400&fit=crop', 'Thick-cut bone-in pork chops.'),
  (2, 'Shrimp Raw 31-40', 'shrimp-raw-31-40', 10.99, 'lb', 'https://images.unsplash.com/photo-1565680018434-b4d1ae9b2c52?w=400&h=400&fit=crop', 'Wild-caught raw shrimp, peeled and deveined.'),
  (2, 'Beef Sirloin Steak', 'beef-sirloin-steak', 11.49, 'lb', 'https://images.unsplash.com/photo-1544025162-d76694265947?w=400&h=400&fit=crop', 'Juicy, tender sirloin steaks.'),
  (2, 'Italian Sausage', 'italian-sausage', 5.99, '1 lb', 'https://images.unsplash.com/photo-1602470520998-f4a52199a3d6?w=400&h=400&fit=crop', 'Seasoned Italian pork sausages.'),
  (2, 'Chicken Thighs Boneless', 'chicken-thighs-boneless', 5.49, 'lb', 'https://images.unsplash.com/photo-1607330289024-1535c6b4e1c1?w=400&h=400&fit=crop', 'Juicy boneless skinless chicken thighs.'),
  (2, 'Ground Turkey 93/7', 'ground-turkey-93-7', 6.99, 'lb', 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop', 'Lean ground turkey.'),
  (2, 'Cod Fillets', 'cod-fillets', 11.99, 'lb', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=400&h=400&fit=crop', 'Wild-caught Atlantic cod fillets.'),
  (2, 'Turkey Breast Deli', 'turkey-breast-deli', 7.49, 'lb', 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=400&fit=crop', 'Oven-roasted turkey breast sliced fresh.'),
  (2, 'Lamb Chops', 'lamb-chops', 14.99, 'lb', 'https://images.unsplash.com/photo-1544025162-d76694265947?w=400&h=400&fit=crop', 'Tender, grass-fed lamb chops.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (3, 'Whole Milk', 'whole-milk', 3.99, 'gallon', 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop', ''),
  (3, 'Large Brown Eggs', 'large-brown-eggs', 5.49, '12 ct', 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=400&h=400&fit=crop', ''),
  (3, 'Unsalted Butter', 'unsalted-butter', 4.49, '1 lb', 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400&h=400&fit=crop', ''),
  (3, 'Greek Yogurt Plain', 'greek-yogurt-plain', 5.99, '32 oz', 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop', ''),
  (3, '2% Reduced Fat Milk', 'reduced-fat-milk', 3.79, 'gallon', 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop', 'Creamy 2% reduced fat milk.'),
  (3, 'Sharp Cheddar Cheese', 'sharp-cheddar-cheese', 5.99, '8 oz', 'https://images.unsplash.com/photo-1589476993333-f55b84301219?w=400&h=400&fit=crop', 'Aged sharp cheddar with rich, tangy flavor.'),
  (3, 'Mozzarella Shredded', 'mozzarella-shredded', 4.49, '16 oz', 'https://images.unsplash.com/photo-1589476993333-f55b84301219?w=400&h=400&fit=crop', 'Finely shredded low-moisture mozzarella.'),
  (3, 'Cream Cheese', 'cream-cheese', 3.49, '8 oz', 'https://images.unsplash.com/photo-1589476993333-f55b84301219?w=400&h=400&fit=crop', 'Smooth and spreadable cream cheese.'),
  (3, 'Half & Half', 'half-and-half', 2.99, '16 oz', 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop', 'Rich and creamy half & half.'),
  (3, 'Sour Cream', 'sour-cream', 2.79, '16 oz', 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=400&h=400&fit=crop', 'Cultured sour cream with a tangy flavor.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (4, 'Sourdough Bread', 'sourdough-bread', 4.99, 'each', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', ''),
  (4, 'Croissants 4-Pack', 'croissants-4-pack', 5.49, '4 ct', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', ''),
  (4, 'Chocolate Chip Cookies', 'chocolate-chip-cookies', 3.99, '12 ct', 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=400&fit=crop', ''),
  (4, 'Whole Wheat Bread', 'whole-wheat-bread', 3.99, '24 oz', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', 'Hearty whole wheat bread.'),
  (4, 'Bagels Everything 6-Pack', 'bagels-everything-6-pack', 5.99, '6 ct', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', 'Chewy everything bagels.'),
  (4, 'Blueberry Muffins', 'blueberry-muffins', 4.49, '4 ct', 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=400&fit=crop', 'Freshly baked blueberry muffins.'),
  (4, 'Ciabatta Rolls', 'ciabatta-rolls', 3.99, '4 ct', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', 'Crusty Italian ciabatta rolls.'),
  (4, 'Flour Tortillas', 'flour-tortillas', 3.29, '10 ct', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop', 'Soft, pliable flour tortillas.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (5, 'Cold Brew Coffee', 'cold-brew-coffee', 4.99, '32 oz', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', ''),
  (5, 'Orange Juice', 'orange-juice', 4.49, '52 oz', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', ''),
  (5, 'Sparkling Water Variety Pack', 'sparkling-water-variety-pack', 5.99, '12 ct', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', ''),
  (5, 'Green Tea Premium', 'green-tea-premium', 5.49, '20 ct', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', 'Premium Japanese green tea bags.'),
  (5, 'Coca-Cola 12-Pack', 'coca-cola-12-pack', 6.99, '12 ct', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', ''),
  (5, 'Coconut Water', 'coconut-water', 3.49, '33.8 oz', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', 'Pure coconut water with natural electrolytes.'),
  (5, 'Apple Juice', 'apple-juice', 4.29, '64 oz', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', '100% pure apple juice.'),
  (5, 'Protein Shake Chocolate', 'protein-shake-chocolate', 2.99, '11 oz', 'https://images.unsplash.com/photo-1590947132387-155cc02f3212?w=400&h=400&fit=crop', 'Chocolate protein shake with 30g of whey protein.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (6, 'Almonds Roasted Unsalted', 'almonds-roasted-unsalted', 7.99, '16 oz', 'https://images.unsplash.com/photo-1526367790999-0150786686a2?w=400&h=400&fit=crop', ''),
  (6, 'Dark Chocolate Bar', 'dark-chocolate-bar', 3.49, '3.5 oz', 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=400&fit=crop', ''),
  (6, 'Tortilla Chips', 'tortilla-chips', 4.29, '13 oz', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', ''),
  (6, 'Mixed Nuts Roasted', 'mixed-nuts-roasted', 8.99, '16 oz', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', 'Roasted mixed nuts.'),
  (6, 'Potato Chips Sea Salt', 'potato-chips-sea-salt', 4.29, '8 oz', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', 'Kettle-cooked potato chips.'),
  (6, 'Granola Bars Variety', 'granola-bars-variety', 5.49, '12 ct', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', 'Chewy granola bars in assorted flavors.'),
  (6, 'Beef Jerky Original', 'beef-jerky-original', 7.99, '3.25 oz', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', 'High-protein beef jerky.'),
  (6, 'Popcorn Butter', 'popcorn-butter', 3.99, '8.5 oz', 'https://images.unsplash.com/photo-1603064752734-4c48eff53d05?w=400&h=400&fit=crop', 'Light, fluffy popcorn with real butter flavor.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (7, 'Frozen Mixed Berries', 'frozen-mixed-berries', 5.99, '48 oz', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', ''),
  (7, 'Vanilla Bean Ice Cream', 'vanilla-bean-ice-cream', 6.49, '1.5 qt', 'https://images.unsplash.com/photo-1631214524020-7e18db9a8f92?w=400&h=400&fit=crop', ''),
  (7, 'Frozen Pizza', 'frozen-pizza', 8.99, 'each', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', ''),
  (7, 'Frozen Broccoli Florets', 'frozen-broccoli-florets', 3.49, '16 oz', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', 'Flash-frozen broccoli florets.'),
  (7, 'Frozen Chicken Nuggets', 'frozen-chicken-nuggets', 7.99, '32 oz', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', 'Crispy breaded chicken nuggets.'),
  (7, 'Edamame Shelled Frozen', 'edamame-shelled-frozen', 4.99, '12 oz', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', 'Shelled edamame soybeans.'),
  (7, 'Frozen Waffles', 'frozen-waffles', 3.99, '10 ct', 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=400&fit=crop', 'Homestyle frozen waffles.'),
  (7, 'Ice Cream Bars', 'ice-cream-bars', 5.99, '6 ct', 'https://images.unsplash.com/photo-1631214524020-7e18db9a8f92?w=400&h=400&fit=crop', 'Creamy vanilla ice cream bars.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (8, 'Extra Virgin Olive Oil', 'extra-virgin-olive-oil', 11.99, '25.4 oz', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', ''),
  (8, 'Basmati Rice', 'basmati-rice', 9.99, '5 lb', 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop', ''),
  (8, 'Pasta Spaghetti', 'pasta-spaghetti', 1.99, '16 oz', 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop', ''),
  (8, 'Kosher Salt', 'kosher-salt', 3.49, '3 lb', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', 'Coarse kosher salt.'),
  (8, 'Black Peppercorns', 'black-peppercorns', 4.99, '4 oz', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', 'Whole black peppercorns.'),
  (8, 'Honey Pure', 'honey-pure', 6.99, '12 oz', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', 'Pure, unfiltered wildflower honey.'),
  (8, 'Canned Diced Tomatoes', 'canned-diced-tomatoes', 1.79, '14.5 oz', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', 'Fire-roasted diced tomatoes.'),
  (8, 'Peanut Butter Creamy', 'peanut-butter-creamy', 4.99, '16 oz', 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop', 'Smooth, creamy peanut butter.'),
  (8, 'Maple Syrup Pure', 'maple-syrup-pure', 9.99, '8.5 oz', 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop', '100% pure Vermont maple syrup.'),
  (8, 'White Rice Long Grain', 'white-rice-long-grain', 3.99, '2 lb', 'https://images.unsplash.com/photo-1626200419199-391ae4be7a41?w=400&h=400&fit=crop', 'Fluffy long-grain white rice.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (9, 'Paper Towels 6-Pack', 'paper-towels-6-pack', 8.99, '6 ct', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', ''),
  (9, 'Dish Soap', 'dish-soap', 3.99, '14 oz', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', ''),
  (9, 'Toilet Paper 24-Pack', 'toilet-paper-24-pack', 16.99, '24 ct', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Ultra-soft double-ply toilet paper.'),
  (9, 'Paper Plates', 'paper-plates', 5.99, '50 ct', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Sturdy, soak-proof paper plates.'),
  (9, 'Trash Bags 13 Gallon', 'trash-bags-13-gallon', 8.49, '30 ct', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Strong, leak-resistant drawstring trash bags.'),
  (9, 'Laundry Detergent', 'laundry-detergent', 9.99, '50 oz', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Concentrated liquid laundry detergent.'),
  (9, 'All-Purpose Cleaner', 'all-purpose-cleaner', 4.49, '32 oz', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Multi-surface all-purpose cleaner.'),
  (9, 'Sponges 6-Pack', 'sponges-6-pack', 3.99, '6 ct', 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=400&h=400&fit=crop', 'Heavy-duty scrub sponges.');

INSERT INTO products (category_id, name, slug, price, unit, image, description) VALUES
  (10, 'Hand Soap Refill', 'hand-soap-refill', 4.49, '33 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', ''),
  (10, 'Toothpaste', 'toothpaste', 5.49, '4.7 oz', 'https://images.unsplash.com/photo-1598387993441-a364f854c3e1?w=400&h=400&fit=crop', ''),
  (10, 'Body Wash', 'body-wash', 6.49, '20 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Hydrating body wash with coconut oil.'),
  (10, 'Shampoo Moisturizing', 'shampoo-moisturizing', 7.99, '13.5 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Moisturizing shampoo with argan oil.'),
  (10, 'Conditioner', 'conditioner', 7.99, '13.5 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Nourishing conditioner with vitamin E.'),
  (10, 'Deodorant Stick', 'deodorant-stick', 5.49, '2.6 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Aluminum-free deodorant.'),
  (10, 'Facial Tissues', 'facial-tissues', 3.29, '120 ct', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Softer-than-ever facial tissues.'),
  (10, 'Sunscreen SPF 50', 'sunscreen-spf-50', 10.99, '6 oz', 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?w=400&h=400&fit=crop', 'Broad-spectrum SPF 50 sunscreen.');
