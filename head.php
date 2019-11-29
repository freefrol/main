<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <style>
        a[name="enter"], a[name="registration"]{
            float: right;
            margin-right: 10px;
        }
        .myModal{
            position: absolute;
            left: 35%;
            top: -300px;
            width: 400px;
            height: 200px;
            border: solid 2px black;
            padding: 10px;
            text-align: center;
        }
        .myModal input{
            width: 98%;
            height: 30px;
            margin-bottom: 15px;
        }
        .myModal input[name]{
            padding-left: 5px;
        }
        .myModal a{
            position: relative;
            float: right;
            top: 0px;
            right: 5px;
        }
        .myModal span{
            position: relative;
            top: -250px;
            font-weight: bold;
        }
        a[name='lk'], a[name='exit'] {
            display: none;
            float: right;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div>
        <?php
            $nameUser = "Гость";
            if(!empty($_SESSION["userName"])){
                $nameUser = $_SESSION["userName"];
            }
        ?>
        <span name="userName"><?php echo $nameUser; ?></span>
        <?php  
        $displayEnter = "none"; 
        $displayExit = "initial";
        if($_SESSION['inside'] != true){
            $displayEnter = "initial";
            $displayExit = "none";
        }
        ?>
        <a href="" name="enter" style="display: <?php echo $displayEnter; ?>;" >Вход</a>
        <a href="registration.php" name="registration" style="display: <?php echo $displayEnter; ?>;" >Регистрация</a>
        <a href="" name="exit" style="display: <?php echo $displayExit; ?>;" >Выход</a>
        <a href="lk.php" name="lk" style="display: <?php echo $displayExit; ?>;" >Личный кабинет</a>
    </div>
    <div class="myModal">
        <a href="">закрыть</a>
        <h2>Введите свой логин и пароль</h2>
        <form onsubmit="send(this, 'autho_obr.php'); return false;">
            <div>
                <input type="text" name="login" placeholder="введите логин" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="введите пароль" required>
            </div>
            <div>
                <input type="submit" value="ВХОД">
            </div>
        </form>
        <span></span>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
    <script >
    let myModal = $(".myModal");
        $("a[name='enter']").click(function(event){
            event.preventDefault();
            let top = +myModal.css("top").slice(0, myModal.css("top").length-2);
            if( top < 0){
                myModal.animate({top: "50%"},1000);
            } else {
                myModal.animate({top: "-300px"},1000);
            }
        });
        
        $(".myModal a").click(function(event){
            event.preventDefault();
            let top = +myModal.css("top").slice(0, myModal.css("top").length-2);
            myModal.animate({top: "-300px"},1000);
            $(".myModal span").html("");
        });
        
        function getXmlHttp(){
            let xmlhttp;
            try {
              xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                  xmlhttp = false;
                }
            }
            if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
              xmlhttp = new XMLHttpRequest();
            }
            return xmlhttp;
        }
        
        function send(form, adres){
            let req = getXmlHttp();
            let params = "";
            let elements = form.querySelectorAll('input');
            for(let i=0; i < elements.length-1; i++){
                params += elements[i].name+"="+elements[i].value+"&";
            }
            req.open('POST', adres, true);
            req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function() {
              if (req.readyState == 4) {
                 if(req.status == 200) {
                     getEcho(req.responseText);
                 }
              }
            };
            req.send(params); 
        }
        
        function getPhp(adres){
            let req = getXmlHttp();
            let message;
            req.open('GET', adres, false);
            req.onreadystatechange = function() {
              if (req.readyState == 4) {
                 if(req.status == 200) {
                      message = req.responseText;
                 }
              }
            };
            req.send(null);
            return message;
        }
        
        function getEcho(echo){
            console.log(echo);
            if(echo == 1){
                $(".myModal span").html("авторизация прошла успешно");
                $(".myModal span").css({color: "green"});
                $(".myModal").delay(1000).animate({top: "-300px"},1000);
                $("a[name='enter']").css({display: "none"});
                $("a[name='registration']").css({display: "none"});
                $("a[name='exit']").css({display: "initial"});
                $("a[name='lk']").css({display: "initial"});
                let userName = getPhp("getUserName.php");
                $("span[name='userName']").html(userName);
            } else {
                $(".myModal span").html("логин или пароль введет неверно");
                $(".myModal span").css({color: "red"});
            }
        }
        
        $("a[name='exit']").click(function(event){
            event.preventDefault();
            $("a[name='enter']").css({display: "initial"});
            $("a[name='registration']").css({display: "initial"});
            $("a[name='exit']").css({display: "none"});
            $("a[name='lk']").css({display: "none"});
            getPhp("exit.php");
        });
    </script>