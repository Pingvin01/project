<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Authorization</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <header>
    <?php require_once('functions.php');
        $id_user=-1;
        siteHeader($id_user);
    ?>
        </header>
        <form method= "POST" action="http://localhost/kursach/php/test.php" id="loginform">
            <div id="login_under_header">
                <section id="login_panel">
                    <section class="login_enter">
                        <label class="login_header_lable">Вхід</label>
                    </section>
                    <label class="login_lables"> Введіть логін </label>
                    <input id="login_input" type="text" placeholder="Логін" name="users_login">
                    <hr class="hr_login">
                    <label class="login_lables"> Введіть пароль </label>
                    <input id="password_input" type="password" placeholder="Пароль" name="users_password">
                    <hr class="hr_login">
                    <section class="login_enter">   <button id="login_button">Увійти</button>    </section>
                    <script>
                        document.querySelector("#login_button").addEventListener("click", checklogin)
                        const login = document.getElementById("login_input")
                        const password = document.getElementById("password_input")

                        function checklogin() {
                            if (login.value!=="" && password.value!=="") {
                                if (login.value.length >= 5 && password.value.length >= 5) {
                                    document.getElementById("loginform").action = "http://localhost/kursach/php/main.php"
                                } else {alert("Логін та пароль повинні мати не менше 4 символів")}
                            } else {alert("Не все поля заполнены")}
                        }
                    </script>
                </section>
            <input name='logined' class='inv_in_out' value='1'>
            </div>
        </form>
    </body>
</html>



<?php
