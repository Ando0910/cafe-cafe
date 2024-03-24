<?php
require 'db.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // トランザクション
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $pdo->commit();

        echo "success";
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "エラー: " . $e->getMessage();
        exit;
    }
} else {
    echo "不正なIDです。";
}
