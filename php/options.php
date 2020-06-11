<?php 
$id_user = 1;
require_once('mysql_querries.php');



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Create article</title>
        <link rel="stylesheet" href="../css/style.css">
        
    </head>
    <body>
        <header>

            <?php require_once('functions.php');
            siteHeader($id_user);
            ?>
        </header>
        
        <div id = "select_option">
            
            <form method= "POST" action="http://localhost/kursach/php/options.php">
                <button class = "button_selector">Створити статтю</button>
                <input class= "inv_in_out" name="id_user" value='<?php echo($id_user); ?>'>
                <input class= "inv_in_out" name="chosen_option" value='1'>
            </form>
        </div>

        <?php 
        
            if(!empty($_POST['head_article'])) {
                if($_POST['head_article'] == "-" || $_POST['data_article'] == "-") {
                    ?>
                    <script>
                        alert("Введено не всі дані");
                    </script>
                    <?php
                } 
                else {
                    $date = date('Y-m-d');
                    $author = 1;
                    $head = $_POST['head_article'];
                    $data = $_POST['data_article'];
                    $add_article_to_base = add_article_to_base($author, $date, $data, $head);
                    ?>
                    <script>
                        alert("Новину додано");
                    </script>
                    <?php
                }
            }
            
        
        
        ?>
                <?php 
                if(!empty($_POST['chosen_option'])) {
                    if($_POST['chosen_option'] == 1){
                        add_article();
                    }
                }
                ?>
        

    </body>

    

</html>

<?php
function add_article() {
    ?>
    
    <div class="admin" id="admin_table">
        <form method= "POST" action="http://localhost/kursach/php/options.php">
            <label>Назва статті</label>
            <input class="input_head" name="head_article">
            <label>Текст статті</label>
            <textarea class="input_data" name="data_article"></textarea>
            <button id = "send"> Надіслати </button>
            <script>
                document.querySelector("#send").addEventListener("click", value_Change);
                
                function value_Change() {
                    
                    var x = document.getElementsByClassName("input_head")
                    var y = document.getElementsByClassName("input_data")
                    if(x[0].value.length===0){
                        x[0].value = "-"
                    }
                    if(y[0].value.length===0){
                        y[0].value = "-"
                    }
                }
            </script>
        </form>
        

    </div>

    <?php
}