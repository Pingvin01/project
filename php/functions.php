<?php
    function siteHeader($id_user){

        if($id_user > 0){
            require_once('mysql_querries.php');
        $resultOne = users_info_top($id_user);
        $rez1 = mysqli_fetch_assoc($resultOne);
        $is_professor = $rez1['is_professor'];
        }

        ?>
        <div class="title_col"> 
            <div class="title">
                <img id="logo_image" src="../images/logo.jpg">
                <label id="header-title">Факультет вищих наук</label>
                <div id="log_unlog_button_panel"> 
                    <form method= "POST" action="http://localhost/kursach/php/test.php">
                        <?php
                                if($id_user == -1) {echo("<button id='log_unlog_button'> Увійти </button>");}
                                    else if($id_user > 0) {
                                echo("<button id='log_unlog_button'> Вийти </button>");
                                }
                        ?>                  
                    </form>
                </div>
            </div>
                <div class="navigation_line">  
                    <section class="navigation_button_section">
                        <form method= "POST" action="http://localhost/kursach/php/main.php">
                            <button class="navigation_button">Головна</button>
                            <input name="id_user" class="inv_in_out" value=<?php echo($id_user) ?>>
                        </form>
                    </section> 
                    <section class="navigation_button_section">
                        <form method= "POST" action="http://localhost/kursach/php/news_blog.php">
                            <button class="navigation_button">Новини</button>
                            <input name="id_user" class="inv_in_out" value='<?php echo($id_user) ?>'>
                        </form>
                    </section> 
                    <section class="navigation_button_section">
                        <form method= "POST" action="http://localhost/kursach/php/our_professors.php">
                            <button class="navigation_button">Наші викладачі</button>
                            <input name="id_user" class="inv_in_out" value=<?php echo($id_user) ?>>
                        </form>
                    </section> 
                    <?php 
                        if($id_user > 0) { 
                            ?>
                                <section class="navigation_button_section">
                                <?php 
                                    if($is_professor == 0) { 
                                        ?>
                                        <form method= "POST" action="http://localhost/kursach/php/students_marks.php">
                                            <button class="navigation_button">Перевірити бали</button>
                                        <?php
                                    }
                                        if($is_professor == 1) {
                                            ?>
                                            <form method= "POST" action="http://localhost/kursach/php/professors_marks.php">
                                                <button class="navigation_button">Виставити бали</button>
                                            <?php
                                        }
                                        if($is_professor == 2) {
                                            ?>
                                            <form method= "POST" action="http://localhost/kursach/php/options.php">
                                                <button class="navigation_button">Створити статтю</button>
                                            <?php
                                        }
                                    ?>
                                        <input name="id_user" class="inv_in_out" value=<?php echo($id_user) ?>>
                                    </form>
                        
                                </section> 
                            <?php

                        }
                    ?>
                </div>
        </div>
    <div id="inv_fixed_div"> a </div>
    <?php
    }
    
    function our_professors($id_subject) 
    {
        require_once('mysql_querries.php');
        $resultNew = professors_edu_sub($id_subject);
        $id_professors[]=50;
        $num_of_prof = 0;
        $is_even = 0;

        while($rezNew = mysqli_fetch_assoc($resultNew)) {
            $num_of_prof++;
            $id_professors[$num_of_prof] = $rezNew['id_professor'];
        }
        if($num_of_prof % 2 == 1) {
            $is_even = 1;
        }
        ?>
        <section id="professors_table">
        <?php 
        if($is_even == 0){
            for($i=1; $i <= $num_of_prof; $i = $i+2) {
                ?>
                <div class="prof_row">
                <?php
                create_prof($id_professors[$i]);
                create_prof($id_professors[($i+1)]);
                ?>
                </div>
                <?php
            }
        }
        else {
            for($i=1; $i < $num_of_prof; $i = $i+2) {
                ?>
                <div class="prof_row">
                <?php
                create_prof($id_professors[$i]);
                create_prof($id_professors[($i+1)]);
                ?>
                </div>
                <?php
            }
            ?><div class="prof_row"><?php
            create_prof($id_professors[$num_of_prof]);
            ?></div> </section> <?php
        }

    }
    function create_prof($id_professor)
    {
        require_once('mysql_querries.php');
        $resultProf = about_prof($id_professor);
        $rezProf = mysqli_fetch_assoc($resultProf);
        ?>
        <section class="prof_place">
            <img class="prof_photo" src='<?php echo("../images/" . $rezProf['prof_photo']); ?>'>
            
            <div class="prof_data">
                <section class="prof_name">
                    <h3 class="prof_ref"><?php echo($rezProf['name']); ?></h3>
                </section>
                <section class="prof_level">
                    <h4 class="prof_ref"><?php echo($rezProf['prof_level']); ?></h4>
                </section>
                <section class="prof_biography">
                    <label><?php echo($rezProf['prof_biography']); ?></label>
                </section>
            </div>
        </section>
        <?php
    }