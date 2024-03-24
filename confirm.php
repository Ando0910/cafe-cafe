<?php

session_start();
// POSTリクエストからのアクセスでない、または必要なデータがPOSTされていない場合は、contact.phpにリダイレクトする
if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['name'], $_POST['kana'], $_POST['tel'], $_POST['email'], $_POST['body'])
) {
    header('Location: contact.php');
    exit;
}
if (isset($_POST['confirm_submission'])) {
    // フォーム送信に成功したことを示すフラグをセッションに設定
    $_SESSION['form_submitted'] = true;

    // complete.phpへリダイレクト
    header('Location: complete.php');
    exit;
}
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // トークンの検証
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header('Location: index.php');
        exit;
    }
    // POSTデータを変数に格納
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
    if (!preg_match("/^[0-9]+$/", $tell)) {
        $errors['tel'] = "電話番号は0-9の数字のみでご入力ください。";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "メールアドレスは正しくご入力ください。";
    }
    if (empty($message)) {
        $errors['body'] = "お問い合わせ内容は必須入力です。";
    }

    // エラーがある場合、入力データとエラーメッセージをセッションに保存し、contact.phpにリダイレクト
    if (!empty($errors)) {
        $_SESSION['form_data'] = $_POST;
        $_SESSION['errors'] = $errors;
        header('Location: contact.php');
        exit;
    }
}
$_SESSION['form_submitted'] = true;
$_SESSION['form_data'] = [
    'name' => $_POST['name'],
    'kana' => $_POST['kana'],
    'tel' => $_POST['tel'],
    'email' => $_POST['email'],
    'body' => $_POST['body'],
];
// $_SESSION['form_data'] = [
//     'name' => $_POST['name'],
//     'kana' => $_POST['kana'],
//     'tel' => $_POST['tel'],
//     'email' => $_POST['email'],
//     'body' => $_POST['body'],
// ];
require 'db.php';
?>
<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ress.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/confirm.css">
    <title>4-5 cafe-cafe</title>
</head>
<?php require 'header.php'; ?>
<section class="form-sec">
    <div class="form-sec__area">
        <h2>お問い合わせ</h2>
        <form method="post" class="form" action="complete.php">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="disc">
                <p>下記の内容をご確認の上送信ボタンを押してください<br>
                    内容を訂正する場合は戻るを押してください。
                </p>
            </div>
            <div class="form1">
                <dl>
                    <dt><label for="name">氏名</label></dt>
                    <dd><?php echo $name; ?></dd>
                    <dt><label for="kana">フリガナ</label></dt>
                    <dd><?php echo $kana; ?></dd>
                    <dt><label for="tell">電話番号</label></dt>
                    <dd><?php echo $tell; ?></dd>
                    <dt><label for="email">メールアドレス</label></dt>
                    <dd><?php echo $email; ?></dd>
                </dl>
            </div>
            <div class="form2">
                <dl>
                    <dt><label for="message">お問い合わせ内容</label></dt>
                    <dd><?php echo nl2br($message); ?></dd>
                </dl>
            </div>
            <div class="button-area">
                <input type="hidden" name="action" value="return_from_confirm">
                <button class="submit-button" type="submit">送　信</button>
        </form>
        <div class="return-button-area">
            <form action="contact.php" method="post">
                <input type="hidden" name="action" value="return_from_confirm">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>">
                <input type="hidden" name="kana" value="<?php echo htmlspecialchars($kana, ENT_QUOTES); ?>">
                <input type="hidden" name="tel" value="<?php echo htmlspecialchars($tell, ENT_QUOTES); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>">
                <input type="hidden" name="body" value="<?php echo htmlspecialchars($message, ENT_QUOTES); ?>">
                <button type="submit-button" class="return-button">戻る</button>
            </form>
        </div>

    </div>
</section>
<?php require 'footer.php'; ?>
