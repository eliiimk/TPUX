<?php
header('Content-Type: application/json');

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '29092231', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Récupération des paramètres GET pour la pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 12; // Nombre de produits par page
    $offset = ($page - 1) * $limit; // Calcul de l'offset

    // Récupérer les produits avec pagination
    $stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer le total des produits
    $stmt_total = $pdo->query("SELECT COUNT(*) FROM products");
    $total = $stmt_total->fetchColumn();

    // Retourner les produits et le total pour la pagination
    echo json_encode([
        'total' => $total,
        'products' => $products,
    ]);
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un message JSON
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
}
?>


