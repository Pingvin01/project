<?php 
$id_user = -1;
$id_user = $_POST['id_user'];
require_once('mysql_querries.php');
$resultTwo = subjects_id();
$sub_name[] = 50;
$count_of_sub = 0;
while($rez2 = mysqli_fetch_assoc($resultTwo)) {
    $count_of_sub++;
    $sub_name[$count_of_sub] = $rez2['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Our professors</title>
        <link rel="stylesheet" href="../css/style.css">
        
    </head>
    <body>
        <header>

            <?php require_once('functions.php');
            siteHeader($id_user);
            ?>
        </header>
        
        <div id="professors">
            <section id="subjects_buttons">

            <?php 
            for($i = 1; $i <=$count_of_sub;$i++) {
                ?>
                <form method= "POST" action="http://localhost/kursach/php/our_professors.php" class="sub_form">
                    <input name='id_sub' class="inv_in_out" value='<?php echo($i); ?>'>
                    <input name='id_user' class="inv_in_out" value='<?php echo($id_user); ?>'>
                    <button class="sub_button" id='sub_button<?php echo($i); ?>'><?php echo($sub_name[$i]); ?></button>
                <?php 
                    if(!empty($_POST['id_sub']) && $_POST['id_sub'] == $i) {
                        ?>
                        <style>
                             <?php echo("#sub_button".$i." { background-color: red; }") ?>
                        </style>
                        <?php
                    }
                    else {
                        ?>
                        <style>
                             <?php echo("#sub_button".$i." { background-color: orange; }") ?>
                        </style>
                        <?php
                    }
                    if(empty($_POST['id_sub'])) {
                        ?>
                        <style>
                             <?php echo("#sub_button1 { background-color: red; }") ?>
                        </style>
                        <?php
                    }
                ?>
                </form>
            <?php
            }
            ?>
            </section>
            <hr class="hr_prof">
            <?php 
                if(empty($_POST['id_sub']) || $_POST['id_sub'] == 1) {
                    our_professors(1);
                }
                else {
                    our_professors($_POST['id_sub']);
                }
            ?>
        </div>
    </body>
</html>