<?php 
$title = "Регистрация";
include("head.php");
?>
    <style>
        .reg{
            max-width: 900px;
            margin: 10% auto;
        }
        .reg input{
            width: 100%;
            height: 30px;
            font-size: 14pt;
            margin: 5px;
            padding-left: 10px;
        }
    </style>
    <form class="reg" onsubmit="checkPass(this, 'reg_obr.php'); return false;">
        <input required name="login" type="text" placeholder="введите логин" autocomplete="off">
        <input required name="password" type="password" placeholder="введите пароль" autocomplete="off">
        <input required class="password2" type="password" placeholder="подтвердите пароль" autocomplete="off">
        <input required name="name" type="text" placeholder="введите имя" autocomplete="off">
        <input required name="lastName" type="text" placeholder="введите фамилию" autocomplete="off">
        <input type="submit" value="Зарегистрироваться">
    </form>
    <script>
        function checkPass(form, adres){
            let pass = form.querySelector("input[name='password']");
            let pass2 = form.querySelector(".password2");
            if(pass.value == pass2.value){
                send(form, adres);
            } else {
                pass.value = "";
                pass2.value = "";
                alert("пароли не совпадают");
            }
        }
    </script>
</body>
</html>