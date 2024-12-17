<?php
require_once 'vendor/autoload.php'; 

$faker = Faker\Factory::create(); 

$pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '29092231'); 

$images = ['tshirt.png', 'pantalon.png', 'jogging.png', 'sweat.png', 'chaussures.png']; 

$stmt = $pdo->query("SELECT COUNT(*) FROM products");
$currentCount = $stmt->fetchColumn();


$targetCount = rand(500, 1000); 
$productsToAdd = $targetCount - $currentCount;

if ($productsToAdd > 0) {
    for ($i = 0; $i < $productsToAdd; $i++) {
        $name = ucfirst($faker->word());
        $description = $faker->sentence(15);
        $price = $faker->randomFloat(2, 5, 500);

        $image_url = 'images/' . $images[array_rand($images)];

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image_url]);
    }

    echo "$productsToAdd produits ont été ajoutés !";
} else {
    echo "Il y a déjà $currentCount produits dans la base de données.";
}
?>