<?php
session_start();
// フォームからの送信が完了しているかチェック
if (!isset($_SESSION['form_submitted'])) {
    // フォームからの送信が確認できない場合はトップページなどにリダイレクト
    header('Location: contact.php');
    exit;
} else {
    // チェック後はフラグをクリア
    unset($_SESSION['form_submitted']);
}
// フォームデータをセッションから削除
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ress.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/complete.css">
    <title>4-5 cafe-cafe</title>
</head>
<?php require 'header.php'; ?>
<section class="form-sec">
    <div class="form-sec__area">
        <h2>お問い合わせ</h2>
        <div class="disc">
            <p>お問い合わせ頂きありがとうございます。<br>
                送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
            </p>
            <div>
                <a href="index.php">トップへ戻る</a>
            </div>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>
