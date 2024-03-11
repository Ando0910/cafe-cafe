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
        'nameA' => $_POST['nameA'] ?? '',
        'kana' => $_POST['kana'] ?? '',
        'tell' => $_POST['tell'] ?? '',
        'email' => $_POST['email'] ?? '',
        'message' => $_POST['message'] ?? '',
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
                    <?php if (!empty($errors['nameA'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['nameA'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="nameA" id="nameId" placeholder="山田太郎" value="<?php echo htmlspecialchars($formData['nameA'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="kana">フリガナ<span>*</span></label></dt>
                    <?php if (!empty($errors['kana'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['kana'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="kana" id="kanaId" placeholder="ヤマダタロウ" value="<?php echo htmlspecialchars($formData['kana'] ?? '', ENT_QUOTES); ?>"></dd>
                    <dt><label for="tell">電話番号</label></dt>
                    <?php if (!empty($errors['tell'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['tell'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><input type="text" name="tell" id="tellId" placeholder="09012345678" value="<?php echo htmlspecialchars($formData['tell'] ?? '', ENT_QUOTES); ?>"></dd>
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
                    <?php if (!empty($errors['message'])) : ?>
                        <div class="error"><?php echo htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php endif; ?>
                    <dd><textarea name="message" id="messageId"><?php echo htmlspecialchars($formData['message'] ?? '', ENT_QUOTES); ?></textarea></dd>
                </dl>
            </div>
            <div class="button-area">
                <button type="submit">送　信</button>
            </div>
        </form>
    </div>
</section>
<?php require 'footer.php'; ?>
<script type="text/javascript" src="/js/contact.js"></script>

</body>

</html>
