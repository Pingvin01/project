<?php 
$id_user = -1;
if(!empty($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
}
if(!empty($_POST['users_login']) && !empty($_POST['users_password'])){
    $login = $_POST['users_login'];
    $password = $_POST['users_password'];
    require_once('mysql_querries.php');
    $resultOne = users_info($login);
    if ( $rez1 = mysqli_fetch_assoc($resultOne)) {  
        if(md5($password) == $rez1['password']) {
            $id_user= $rez1['id_user'];
            $is_professor = $rez1['is_professor']; 
        }
        else {
            ?>
        <!DOCTYPE html>
        <html lang="en">
            <script> alert("Неверный логин или пароль"); 
            window.addEventListener(onload, location.href = 'http://localhost/kursach/php/test.php')
            </script>

        </html>  <?php
        }
    }
    else { ?>
        <!DOCTYPE html>
        <html lang="en">
            <script> alert("Неверный логин или пароль"); 
            window.addEventListener(onload, location.href = 'http://localhost/kursach/php/test.php')
            </script>

        </html>  <?php
    }
}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Main page</title>
        <link rel="stylesheet" href="../css/style.css">
        
    </head>
    <body>
        <header>

            <?php require_once('functions.php');
            siteHeader($id_user);
            ?>
        </header>
        <div id="slider_beckground">
            <div class="slider">
                <input type="radio" name="switch" id="btn1" checked>
                <input type="radio" name="switch" id="btn2">
                <input type="radio" name="switch" id="btn3">
                <input type="radio" name="switch" id="btn4">
                
                <div class="switch">
                    <label for="btn1"></label>
                    <label for="btn2"></label>
                    <label for="btn3"></label>
                    <label for="btn4"></label>
                </div>
                
                <div class="slider-inner">
                    <div class="slides">
                        <img src="../images/slider_1.jpg"/>
                        <img src="../images/slider_2.jpg"/>
                        <img src="../images/slider_3.jpg"/>
                        <img src="../images/slider_4.jpg"/>
                    </div>
                </div>
  
            </div>
        </div>

        <?php 
            require_once('mysql_querries.php');
            $resultTwo = latest_article_id();
            $rez2 = mysqli_fetch_assoc($resultTwo);
            $max_article_id = $rez2['id_article'];
        ?>

        <div id='news_blog'>
            
        <h2 id="latest_news_line">↓ Останні новини ↓</h2>
            <?php 
                for($i = 0; $i < 2; $i++){
                    $id_article = $max_article_id;
                    $resultTwo = article_all_data($id_article);
                    $rez2 = mysqli_fetch_assoc($resultTwo);

                
            ?>
            <section class= 'article'>
                <div class='article_head'>
                    <?php echo($rez2['article_head']); ?>
                </div>
                <div class='article_data'>
                    <section class='article_photo'>
                    <img class="article_image" src='<?php echo("../images/" . $rez2['pic_url']); ?>' alt="альтернативный текст">
                    </section>
                    <section class='article_text'>
                        <label class="article_text_text">
                            <?php echo($rez2['data']); ?>
                        </label>
                        
                    </section>
                </div>
                <section class="article_date">
                    <?php echo($rez2['date']); ?>
                </section>
            </section>
         <?php 
        $max_article_id = $max_article_id - 1;
                }         
        ?>
        </div>
    </body>
</html>
