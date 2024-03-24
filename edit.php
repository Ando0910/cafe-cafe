<?php
session_start();

require 'db.php';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = trim($_POST["name"] ?? '');
    $kana = trim($_POST["kana"] ?? '');
    $tell = trim($_POST["tel"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["body"] ?? '');
    // バリデーションチェック
    if (empty($name) || mb_strlen($name) > 10) {
        $errors['name'] = "氏名は必須入力です。10文字以内でご入力ください。";
    }
    if (empty($kana) || mb_strlen($kana) > 10) {
        $errors['kana'] = "フリガナは必須入力です。10文字以内でご入力ください。";
    }
    if (!preg_match("/^[0-9]+$/", $tell) && !empty($tell)) {
        $errors['tel'] = "電話番号は0-9の数字のみでご入力ください。";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "メールアドレスは正しくご入力ください。";
    }
    if (empty($message)) {
        $errors['body'] = "お問い合わせ内容は必須入力です。";
    }

    // エラーがある場合、入力データとエラーメッセージをセッションに保存し、edit.phpにリダイレクト
    if (!empty($errors)) {
        $_SESSION['form_data'] = $_POST;
        $_SESSION['errors'] = $errors;
        header('Location: edit.php?id=' . urlencode($_POST['id']));
        exit;
    } else {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // トランザクション
            $pdo->beginTransaction();
            // SQLインジェクション
            $sql = "UPDATE contacts SET name = ?, kana = ?, tel = ?, email = ?, body = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $kana, $tell, $email, $message, $id]);

            $pdo->commit();

            // 更新後にcontact.phpへリダイレクト
            header("Location: contact.php");
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "エラー データベース接続失敗: " . $e->getMessage();
        }
    }
} else {

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");

            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $contact = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$contact) {
                throw new Exception("該当するデータが見つかりません。");
            }
        } catch (Exception $e) {
            echo "エラー: " . $e->getMessage();
            exit;
        }
    } else {
        echo "不正なIDです。";
        exit;
    }
    // セッションからエラーメッセージとフォームデータを取得
    $errors = $_SESSION['errors'] ?? [];
    $formData = $_SESSION['form_data'] ?? [];

    // セッションのエラーメッセージとフォームデータをクリア
    unset($_SESSION['errors'], $_SESSION['form_data']);
}

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
        <h2>お問い合わせ内容の編集</h2>
        <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" class="form" method="post">
            <!-- トークン-->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="label">
                <p>下記の項目をご記入の上送信ボタンを押してください</p>
            </div>
            <div class="disc">
                <p>編集が必要な部分だけ編集して下さい。<br>
                    <span>*</span>は必須項目となります。<br>

                </p>
            </div>
            <div class="form1">
                <dl>
                    <dt><label for="name">氏名<span>*</span></label></dt>
                    <?php if (!empty($errors['name'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="name" id="nameId" value="<?php echo htmlspecialchars($formData['name'] ?? $contact['name'], ENT_QUOTES); ?>"></dd>
                    <dt><label for="kana">フリガナ<span>*</span></label></dt>
                    <?php if (!empty($errors['kana'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['kana'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="kana" value="<?php echo htmlspecialchars($formData['kana'] ?? $contact['kana'], ENT_QUOTES); ?>"></dd>
                    <dt><label for="tell">電話番号</label></dt>
                    <?php if (!empty($errors['tel'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['tel'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="tel" value="<?php echo htmlspecialchars($formData['tel'] ?? $contact['tel'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="email">メールアドレス<span>*</span></label></dt>
                    <?php if (!empty($errors['email'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="email" name="email" value="<?php echo htmlspecialchars($formData['email'] ?? $contact['email'], ENT_QUOTES); ?>"></dd>
                </dl>
            </div>
            <div class="form2">
                <dl>
                    <dt class="label"><label for="message">お問い合わせ内容をご記入ください<span>*</span></label></dt>
                    <?php if (!empty($errors['body'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['body'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><textarea name="body" id="messageId"><?php echo htmlspecialchars($formData['body'] ?? $contact['body'] ?? '', ENT_QUOTES); ?></textarea></dd>
                </dl>
            </div>
            <div class="button-area">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($contact['id']); ?>">
                <button type="submit">送　信</button>
            </div>

        </form>
    </div>
</section>

<?php require 'footer.php'; ?>

</body>

</html>
