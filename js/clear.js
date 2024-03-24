"use strict";
    document.addEventListener('DOMContentLoaded', (event) => {
        window.addEventListener('beforeunload', (event) => {
            // フォーム送信によるページ遷移の場合はセッションクリア処理を行わない
            if (document.activeElement.form && document.activeElement.form.method === "post") {
                return;
            }

            // AJAXを使用してセッションクリアのPHPを呼び出し
            navigator.sendBeacon('/clear.php');
        });
    });
