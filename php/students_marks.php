<?php
        require_once('mysql_querries.php');
        $resultOne = students_info($_POST['id_user']);
        $rez1 = mysqli_fetch_assoc($resultOne);
        //print_r($rez1); ****************
        $id_student = $rez1['id_student'];
        $students_name = $rez1['name'];
        $level = $rez1['level'];
        $group_name = $rez1['group_name'];

        $resultTwo = students_subjects($level);
        $num_of_subjects = 0;
        while($rez2 = mysqli_fetch_assoc($resultTwo)) {
            if ($rez2['number_of_labs'] != 0) {
                $sub_name[$num_of_subjects] = $rez2['name'];
                $sub_lab[$num_of_subjects] = $rez2['number_of_labs'];
                $num_of_subjects++;
            }
        }
        $max = 0;
        for($i = 0; $i < $num_of_subjects; $i++) {
            if($sub_lab[$i] > $max) {
                $max = $sub_lab[$i];
            }
        }
         ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Marks</title>
            <link rel="stylesheet" href="../css/style.css">
        </head>
         <body>
            <header>
                <?php require_once('functions.php');
                siteHeader($_POST['id_user']);
                ?>
            </header>
            <div id="students_marks_section">
                <section id="students_marks_table"> 
                    <label class="login_header_lable">Щоденник студента групи <?php echo($group_name) ?> <?php echo($students_name) ?></label>
                    <table id="student_marks_table">
                        <tr> <td class='dairy_table_head' rowspan="2">Предмет</td><td class='dairy_table_head' colspan="<?php echo($max) ?>">Оцінки</td> <td class='dairy_table_head' rowspan="2">Разом</td> </tr>
                        <?php
                            echo("<tr class='input_marks_row'>");
                            for ($i = 0; $i < $max; $i++) {
                                echo("<td class='dairy_table_lab'> Лаб_" . ($i+1) . "</td>");
                            }
                            echo("</tr>");

                            for($i = 1; $i <= $num_of_subjects; $i++) {
                                $resultFour = student_marks($id_student, $sub_name[($i - 1)]);
                                $marks[]=$max;
                                $j = 1;
                                $all_sum = 0;
                                while($rez4 = mysqli_fetch_assoc($resultFour)) {
                                    $marks[$rez4['lab_num']] = $rez4['mark'];
                                    $all_sum += $marks[$rez4['lab_num']];
                                }
                                $resultThree = student_marks($id_student, $sub_name[($i - 1)]);
                                echo ("<tr> <td class='dairy_table_head'>". $sub_name[($i - 1)] .":</td>");
                                while($rez3 = mysqli_fetch_assoc($resultThree)) {
                                    if ($marks[$j] == 0) {echo("<td class='dairy_table_not_sum'> N/A</td>");}
                                    else {echo("<td class='dairy_table'>" . $marks[$j] . "</td>");}
                                    $j++;
                                }
                                for ($k = $j; $k <= $max; $k++){
                                    if ($sub_lab[$i-1] >= $k) {echo("<td class='dairy_table'>-</td>");}
                                    else {echo("<td class='dairy_table'>  </td>");}
                                }
                                if($all_sum < 36) {echo ("<td class='dairy_table_not_sum'>" . $all_sum . "</td></tr>");}
                                else {echo ("<td class='dairy_table_sum'>" . $all_sum . "</td></tr>");}
                            }
                        ?>
                    </table>
                </section>
            </div>
        </body>
    </html>
 

