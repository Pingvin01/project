<?php
    require_once('mysql_querries.php');
    $resultOne = id_professor($_POST['id_user']);
    $rez1 = mysqli_fetch_assoc($resultOne);
    $id_professor = $rez1['id_professor'];
    $id_user = $rez1['id_user'];
    $id_subject = $rez1['id_subject'];
    $reading_levels = $rez1['taught_levels'];
    $reading_levels_arr[] = 4;
    $reading_groups_id[] = 16;
    $group_count = 0;
    $num_of_labs = 0;

    for ($i = 1; $i <= 4; $i++) {
        $reading_levels_arr[$i] = substr($reading_levels, $i-1, 1);
    }
    for ($i = 1; $i <= 4; $i++) {
        if ($reading_levels_arr[$i] == "1") {
            $resultTwo = groups_id($i);
            $rez2 = mysqli_fetch_assoc($resultTwo);

            do {
                $reading_groups_id[$group_count] = $rez2['id_group'];
                $group_count++;
            } while($rez2 = mysqli_fetch_assoc($resultTwo)) ;
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>professor's page</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
        <body>
            <header>
                <?php require_once('functions.php');
                    siteHeader($id_user);
                ?>
            </header>

        <?php 
        if(!empty($_POST['students_in_a_group'])){
            $id_professor = $_POST['id_professor'];
            $id_sub = $_POST['id_sub'];
            for($i = 0; $i < $_POST['students_in_a_group']; $i++) {
                $id_stud = $_POST['student'. $i];
                for($j = 0; $j < $_POST['num_of_labs']; $j++) {
                    if($_POST['mark'.$i.$j] != "-" && $_POST['mark'.$i.$j] != 0) {
                        $lab_num = $j+1;
                        $mark =$_POST['mark'.$i.$j];
                        if($mark <= -1) {
                            $mark = 0;
                        }
                        require_once('mysql_querries.php');
                        $resultSeven = write_students_marks($id_sub, $id_stud, $id_professor, $mark, $lab_num);
                    }
                        
                } 
            }
                
            echo("<script> alert('Оцінки завантажено успішно') </script>");
        }
            

        ?>

        <form method= "POST" action="http://localhost/kursach/php/professors_marks.php">
            <div id="find_group">
                <section id="find_group_body">
                    <label class="prof_text">Оберіть групу</label>
                    <select class="prof_select" name="chosen_group">
                    <?php 
                        for ($i = 0; $i < $group_count; $i++){
                            $resultThree = group_name($reading_groups_id[$i]);
                            $rez3 = mysqli_fetch_assoc($resultThree);
                            echo("<option value='" . $reading_groups_id[$i] ."'>" . $rez3['name'] . "</option>");
                        }
                    ?>
                    </select>
                    <button id="find_button">Знайти</button>
                </section>
            </div>

            <input id="users_id_inv" name="id_user">
            <script>
                document.getElementById("users_id_inv").value = <?php echo($id_user) ?>;
            </script>

        </form>

        <?php 
        if(!empty($_POST['chosen_group'])) { 
            $students_id[] = 40;
            $students_name[] = 40;
            $num_of_students = 0;
            $stud_level = 0;
            $resultFour = students_of_the_group($_POST['chosen_group']);
            $rez4 = mysqli_fetch_assoc($resultFour);
            do  {
                $students_id[$num_of_students] = $rez4['id_student'];
                $students_name[$num_of_students] = $rez4['name'];
                $stud_level = $rez4['level'];
                $num_of_students++;
            } while($rez4 = mysqli_fetch_assoc($resultFour));
            $resultFive = count_of_labs($stud_level, $id_subject);
            $rez5 = mysqli_fetch_assoc($resultFive);
            $num_of_lubs = $rez5['level'];
            $num_of_labs = $rez5['level']; // USE number of labs

        ?>
            <form method= "POST" action="http://localhost/kursach/php/professors_marks.php">
            <div id="professors_marks_section">
                <section id="professors_marks_table">

                <?php 

                    for($i = 0; $i < $num_of_students; $i++) {
                        echo(" <section id = 'input_marks_section'>");
                        echo("<label id='student_name' > ". $students_name[$i] ." </label>");
                        echo("");
                        $resultSix = student_marks_by_subject($students_id[$i], $id_subject);
                        $resultSixCheck = student_marks_by_subject($students_id[$i], $id_subject);
                        $rez6 = mysqli_fetch_assoc($resultSix);
                        $marks_array[] = 15;
                        $lab_array[] = 15;
                        $fill_count = 0;
                        if($rezz = mysqli_fetch_assoc($resultSixCheck)){
                            do {
                                $marks_array[$fill_count] = $rez6['mark'];
                                $lab_array[$fill_count] = $rez6['lab_num'];
                                $fill_count++;
                                        
                            } while($rez6 = mysqli_fetch_assoc($resultSix));
                        }
                            for($j = 0; $j < $num_of_lubs; $j++) {
                                $flack=true;

                                for($k = 0; $k < $fill_count; $k++) {
                                    if($j+1 == $lab_array[$k]) {
                                        echo("<input name='mark". $i . $j ."' class= 'student_mark_allready' placeholder='Лаб". ($j+1) ."' value='". $marks_array[$k] ."' readonly>");
                                        $flack = false; 
                                        break;
                                    }
                                }
                                if($flack){
                                    echo("<input name='mark". $i . $j ."' class= 'student_mark' placeholder='Лаб ". ($j+1) ."' type='number' value=''>");
                                }

                                    
                            }
                            echo("<input name='student". $i ."'  id='students_id_inv' value='". $students_id[$i] ."'>");
                            echo("</section>");
                    }
                ?>
                        <section id = 'input_marks_section'>
                        <button id='into_DB_button'>Занести</button>
                        <input id='students_id_inv' name='id_sub' value='<?php echo($id_subject) ?>'></input>
                        <input id='students_id_inv' name='id_professor' value='<?php echo($id_professor) ?>'></input>
                        <input name='id_user' id='students_id_inv' value='<?php echo($id_user) ?>'></input>
                        <input name='students_in_a_group' id='students_id_inv' value='<?php echo($num_of_students) ?>'></input>
                        <input name='num_of_labs' id='students_id_inv' value='<?php echo($num_of_labs) ?>'></input>
                        </section>
                        <script>
                            document.querySelector("#into_DB_button").addEventListener("click", value_Change);
                            function value_Change() {
                                var x = document.getElementsByClassName("student_mark_allready")
                                var i
                                for (i = 0; i < x.length; i++) {
                                    x[i].value = "-";
                                }
                                var y = document.getElementsByClassName("student_mark")
                                var j
                                for (j = 0; j < x.length; j++) {
                                    if(y[j].value < -1) {
                                        y[j].value = -1;
                                    }       
                                }
                            }
                        </script>
                    </section>
                </div>
            </form>
 
        <?php
        }
        ?>
        </body>
    </html>