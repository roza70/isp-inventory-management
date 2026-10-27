<?php
require __DIR__ . "/../config/db.php";

$types  = ["Router", "Switch", "ONU"];
$errors = [];
$model  = "";
$brand  = "";
$type   = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $model = trim($_POST["model"] ?? "");
    $brand = trim($_POST["brand"] ?? "");
    $type  = trim($_POST["type"] ?? "");

    if ($model === "") {
        $errors[] = "Model is required.";
    } elseif (strlen($model) > 100) {
        $errors[] = "Model must be 100 characters or fewer.";
    }
    if (!in_array($type, $types, true)) {
        $errors[] = "Please select a type.";
    }

    if (count($errors) === 0) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO products (model_name, brand, type)
                 VALUES (:model, :brand, :type)"
            );
            $stmt->execute([
                ":model" => $model,
                ":brand" => $brand === "" ? null : $brand,
                ":type"  => $type
            ]);
            header("Location: list.php?added=1");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                $errors[] = "This model already exists.";
            } else {
                $errors[] = "Database error. Please try again.";
            }
        }
    }
}

$pageTitle = "Add Product";
require __DIR__ . "/../includes/header.php";
?>
<h1>Add Product</h1>

<?php foreach ($errors as $err): ?>
    <p class="msg-err"><?= htmlspecialchars($err) ?></p>
<?php endforeach; ?>

<form method="post">
    <p>
        <label>Model:</label>
        <input type="text" name="model" value="<?= htmlspecialchars($model) ?>">
    </p>
    <p>
        <label>Brand:</label>
        <input type="text" name="brand" value="<?= htmlspecialchars($brand) ?>">
    </p>
    <p>
        <label>Type:</label>
        <select name="type">
            <option value="">-- select --</option>
            <?php foreach ($types as $t): ?>
                <option value="<?= $t ?>" <?= $type === $t ? "selected" : "" ?>><?= $t ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <button type="submit">Save</button>
    <a href="list.php">Cancel</a>
</form>

<?php require __DIR__ . "/../includes/footer.php"; ?>