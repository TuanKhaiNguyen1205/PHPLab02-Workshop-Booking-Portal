<?php
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$getName = (string)($_GET['name'] ?? '');
$postName = (string)($_POST['name'] ?? '');
$requestName = (string)($_REQUEST['name'] ?? '');

function e(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Request Inspector</title>
</head>
<body>
    <h1>Request Inspector (Demo GET vs POST)</h1>
    
    <p><strong>Method hiện tại:</strong> <?= e($method) ?></p>
    <p><strong>$_GET['name']:</strong> <?= e($getName) ?></p>
    <p><strong>$_POST['name']:</strong> <?= e($postName) ?></p>
    <p><strong>$_REQUEST['name']:</strong> <?= e($requestName) ?></p>

    <hr>

    <!-- Form 1: Gửi bằng phương thức GET -->
    <h3>1. Thử nghiệm Form GET</h3>
    <form method="get">
        <input name="name" placeholder="Nhập tên qua GET">
        <button type="submit">Gửi GET</button>
    </form>

    <br>

    <!-- Form 2: Gửi bằng phương thức POST -->
    <h3>2. Thử nghiệm Form POST</h3>
    <form method="post">
        <input name="name" placeholder="Nhập tên qua POST">
        <button type="submit">Gửi POST</button>
    </form>

    <br>
    <p><a href="index.php">Quay lại Catalog</a></p>
</body>
</html>