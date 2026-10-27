<?php
require __DIR__ . "/../config/db.php";

$stmt = $pdo->query("SELECT * FROM products ORDER BY model_name");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = "Products";
require __DIR__ . "/../includes/header.php";
?>
<h1>Products</h1>

<?php if (isset($_GET["added"])): ?>
    <p class="msg-ok">Product added!</p>
<?php endif; ?>

<p><a href="add.php">+ Add Product</a></p>

<?php if (count($products) === 0): ?>
    <p>No products yet.</p>
<?php else: ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Brand</th>
            <th>Type</th>
        </tr>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= (int)$p["id"] ?></td>
            <td><?= htmlspecialchars($p["model_name"]) ?></td>
            <td><?= htmlspecialchars($p["brand"] ?? "") ?></td>
            <td><?= htmlspecialchars($p["type"] ?? "") ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require __DIR__ . "/../includes/footer.php"; ?>