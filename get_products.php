<?php
header('Content-Type: application/json');

try {
    
    $pdo = new PDO('mysql:host=localhost;dbname=testdb', 'root', '29092231', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 12; 
    $offset = ($page - 1) * $limit; 

    
    $stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    $stmt_total = $pdo->query("SELECT COUNT(*) FROM products");
    $total = $stmt_total->fetchColumn();

    
    echo json_encode([
        'total' => $total,
        'products' => $products,
    ]);
} catch (PDOException $e) {
   
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
}
?>


