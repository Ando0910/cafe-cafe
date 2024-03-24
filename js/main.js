"use strict";
// アニメーション
window.addEventListener('scroll', function() {
    const covidElement = document.querySelector('.covid');
    const header = document.querySelector('.header');


    const covidPosition = covidElement.getBoundingClientRect();

    if (covidPosition.top >= window.innerHeight || covidPosition.bottom <= 0) {
        header.classList.add('is-active');
    } else {
        header.classList.remove('is-active');
    }
});


window.addEventListener('scroll', function() {
    const pageTop = document.querySelector('.page-top');
    const targetElement = document.querySelector('.forth-sec');
    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;

    if (window.scrollY + window.innerHeight > targetPosition) {
        pageTop.classList.add('fade-in');
    } else {
        pageTop.classList.remove('fade-in');
    }
});


const toggleBtn = document.querySelector(".sp_toggle-button");
const navSp = document.querySelector(".sp-nav");

if (navSp) {
    toggleBtn.addEventListener("click", () => {
        navSp.classList.toggle("toggle-on");
    });
}


const pcToggleBtn = document.querySelector(".pc_toggle-button");
const navPc = document.querySelector(".pc-sign-in");
const bg = document.querySelector(".pc-sign-in__bg");

function toggleMenuAndBackground() {
    bg.classList.toggle("pc_toggle-on");
    navPc.classList.toggle("pc_toggle-on");


    if (!navPc.classList.contains("pc_toggle-on")) {
        navPc.style.opacity = 0;
        navPc.style.visibility = 'hidden';
    } else {
        navPc.style.visibility = 'visible';
        setTimeout(() => navPc.style.opacity = 1, 0);
    }
}


if (pcToggleBtn && navPc && bg) {
    pcToggleBtn.addEventListener("click", toggleMenuAndBackground);


    bg.addEventListener("click", () => {
        bg.classList.remove("pc_toggle-on");
        navPc.classList.remove("pc_toggle-on");
        navPc.style.opacity = 0;
        navPc.style.visibility = 'hidden';
    });
}

// バリデーション
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        var name = document.getElementById('nameId').value;
        var kana = document.querySelector('input[name="kana"]').value;
        var tell = document.querySelector('input[name="tel"]').value;
        var email = document.querySelector('input[name="email"]').value;
        var message = document.querySelector('textarea[name="body"]').value;
        var errorMessage = "";

        // 名前の検証
        if (name.length === 0 || name.length > 10) {
            errorMessage += "氏名は必須入力です。10文字以内でご入力ください。\n";
        }
        // フリガナの検証
        if (kana.length === 0 || kana.length > 10) {
            errorMessage += "フリガナは必須入力です。10文字以内でご入力ください。\n";
        }
        // 電話番号の検証
        if (!tell.match(/^[0-9]+$/)) {
            errorMessage += "電話番号は0-9の数字のみでご入力ください。\n";
        }
        // メールアドレスの検証
        if (email.length === 0 || !email.match(/^[^@]+@[^@]+\.[^@]+$/)) {
            errorMessage += "メールアドレスは正しくご入力ください。\n";
        }
        // メッセージの検証
        if (message.length === 0) {
            errorMessage += "お問い合わせ内容は必須入力です。\n";
        }
        // エラーメッセージがあればアラート表示し、送信をキャンセル
        if (errorMessage !== "") {
            alert(errorMessage);
            event.preventDefault();
        }
    });
});

//  削除
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var id = this.getAttribute('data-id');
            if (confirm('本当に削除しますか？')) {
                fetch('delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === 'success') {
                        this.closest('tr').remove();
                    } else {
                        alert('削除に失敗しました。');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});


