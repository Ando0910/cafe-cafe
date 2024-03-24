<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// エラーメッセージとフォームデータを初期化
$errors = $_SESSION['errors'] ?? [];
$formData = [];

// エラー時、「戻る」ボタンが押された場合にセッションまたはPOSTからフォームデータを取得
if (!empty($_SESSION['form_data'])) {
    // エラー時
    $formData = $_SESSION['form_data'];
} elseif (isset($_POST['action']) && $_POST['action'] === 'return_from_confirm') {
    // 「戻る」ボタンからのPOSTデータがある場合
    $formData = [
        'name' => $_POST['name'] ?? '',
        'kana' => $_POST['kana'] ?? '',
        'tel' => $_POST['tel'] ?? '',
        'email' => $_POST['email'] ?? '',
        'body' => $_POST['body'] ?? '',
    ];
}
// セッションのエラーメッセージとフォームデータをクリア
unset($_SESSION['errors'], $_SESSION['form_data']);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ress.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/contact.css">
    <title>4-5 cafe-cafe</title>
</head>
<?php require 'header.php'; ?>
<section class="form-sec">
    <div class="form-sec__area">
        <h2>お問い合わせ</h2>
        <form action="confirm.php" class="form" method="post">
            <!-- トークン-->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="label">
                <p>下記の項目をご記入の上送信ボタンを押してください</p>
            </div>
            <div class="disc">
                <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                    なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
                    <span>*</span>は必須項目となります。
                </p>
            </div>
            <div class="form1">
                <dl>
                    <dt><label for="name">氏名<span>*</span></label></dt>
                    <?php if (!empty($errors['name'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="name" id="nameId" placeholder="山田太郎" value="<?php echo htmlspecialchars($formData['name'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="kana">フリガナ<span>*</span></label></dt>
                    <?php if (!empty($errors['kana'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['kana'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="kana" id="kanaId" placeholder="ヤマダタロウ" value="<?php echo htmlspecialchars($formData['kana'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="tell">電話番号</label></dt>
                    <?php if (!empty($errors['tel'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['tel'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="tel" id="tellId" placeholder="09012345678" value="<?php echo htmlspecialchars($formData['tel'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="email">メールアドレス<span>*</span></label></dt>
                    <?php if (!empty($errors['email'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="email" id="emailId" placeholder="test@test.co.jp" value="<?php echo htmlspecialchars($formData['email'] ?? '', ENT_QUOTES); ?>"></dd>
                </dl>
            </div>
            <div class="form2">
                <dl>
                    <dt class="label"><label for="message">お問い合わせ内容をご記入ください<span>*</span></label></dt>
                    <?php if (!empty($errors['body'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['body'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><textarea name="body" id="messageId"><?php echo htmlspecialchars($formData['body'] ?? '', ENT_QUOTES); ?></textarea></dd>
                </dl>
            </div>
            <div class="button-area">
                <button type="submit">送　信</button>
            </div>
        </form>
    </div>
</section>
<section>
    <?php
    require 'db.php';

    try {
        // PDOインスタンスの作成
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");

        // データの更新
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // フォームからのデータを取得して更新
            $sql = "UPDATE contacts SET name = ?, kana = ?, tel = ?, email = ?, body = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST['name'], $_POST['kana'], $_POST['tel'], $_POST['email'], $_POST['body'], $_POST['id']]);
            // echo "データを更新しました。<br>";
        }

        // データの表示
        $stmt = $pdo->query("SELECT * FROM contacts");
        echo "<table class='cafe_table'>";
        echo "<tr>
                <th>ID</th><th>名前</th><th>フリガナ</th><th>電話番号</th><th>メール</th><th>お問合せ内容</th><th></th><th></th>
                </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['kana']) . "</td>
                        <td>" . htmlspecialchars($row['tel']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . nl2br(htmlspecialchars($row['body'])) . "</td>
                        <td><a href='edit.php?id=" . htmlspecialchars($row['id']) . "'>編集</a></td>
                        <td><a href='#' class='delete-link' data-id='" . htmlspecialchars($row['id']) . "'>削除</a></td>
                        </tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    ?>
</section>
<?php require 'footer.php'; ?>

</body>

</html>
