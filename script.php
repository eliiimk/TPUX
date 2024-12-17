<?php
require_once 'vendor/autoload.php'; // Assurez-vous que Faker est installé avec Composer

$faker = Faker\Factory::create(); // Utilise la classe de fakerphp

$pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '29092231'); // Changez les paramètres de connexion

$images = ['tshirt.png', 'pantalon.png', 'jogging.png', 'sweat.png', 'chaussures.png']; // Liste des images locales
// Vérifier le nombre de produits existants
$stmt = $pdo->query("SELECT COUNT(*) FROM products");
$currentCount = $stmt->fetchColumn();

// Calculer combien de produits ajouter pour atteindre un total entre 500 et 1000
$targetCount = rand(500, 1000); // Nombre cible de produits
$productsToAdd = $targetCount - $currentCount;

if ($productsToAdd > 0) {
    for ($i = 0; $i < $productsToAdd; $i++) {
        $name = ucfirst($faker->word());
        $description = $faker->sentence(15);
        $price = $faker->randomFloat(2, 5, 500);
        // Sélectionner une image aléatoire parmi les images locales
        $image_url = 'images/' . $images[array_rand($images)];

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image_url]);
    }

    echo "$productsToAdd produits ont été ajoutés !";
} else {
    echo "Il y a déjà $currentCount produits dans la base de données.";
}
?>