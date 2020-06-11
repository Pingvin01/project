<?php 
$id_user = -1;
$id_user = $_POST['id_user']; 
require_once('mysql_querries.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Our news</title>
        <link rel="stylesheet" href="../css/style.css">
        
    </head>
    <body>
        <header>
            <?php require_once('functions.php');
            siteHeader($id_user);
            ?>
        </header>
        <?php 
            $resultOne = latest_article_id();
            $rez1 = mysqli_fetch_assoc($resultOne);
            $max_article_id = $rez1['id_article'];
        ?>
        <div id='news_blog'>
        
        <?php 
        while($max_article_id > 0){
            $resultTwo = article_all_data($max_article_id);
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
