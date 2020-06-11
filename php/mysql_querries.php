<?php 
function users_info($login) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT * FROM users_table WHERE login = '" . $login . "'");
    mysqli_close($connection);
    return $result;
}

function users_info_top($user_id) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT is_professor FROM users_table WHERE id_user=".$user_id);
    mysqli_close($connection);
    return $result;
}


function students_info($id_user) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT stud_table.id_student, stud_table.name, stud_table.level, group_table.name AS group_name  
    FROM students_diary.stud_table LEFT JOIN students_diary.group_table ON stud_table.id_group=group_table.id_group
    WHERE stud_table.id_user=" . $id_user);
    mysqli_close($connection);
    return $result;
}

function students_subjects($level) {
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT subject_table.level" . $level . " AS number_of_labs, subject_table.name, subject_table.id_subject FROM students_diary.subject_table");
    mysqli_close($connection);
    return $result;
}

function student_marks($id_student, $sub_name) {
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT marks_table.id_subject, marks_table.lab_num, marks_table.mark 
    FROM students_diary.marks_table LEFT JOIN students_diary.subject_table ON marks_table.id_subject=subject_table.id_subject
    WHERE marks_table.id_student=" . $id_student . " AND subject_table.name= '" . $sub_name ."'");
    mysqli_close($connection);
    return $result;
}

function id_professor($id_user) {
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT prof_table.id_professor, prof_table.id_subject, prof_table.taught_levels, prof_table.id_user  
    FROM students_diary.prof_table
    WHERE prof_table.id_user =". $id_user);
    mysqli_close($connection);
    return $result;
}

function groups_id($level){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT group_table.id_group 
    FROM students_diary.group_table
    WHERE level =" . $level);
    mysqli_close($connection);
    return $result;
}

function group_name($id_group){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT group_table.name 
    FROM students_diary.group_table
    WHERE group_table.id_group =" . $id_group);
    mysqli_close($connection);
    return $result;
}
function students_of_the_group($id_group){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT stud_table.id_student, stud_table.name, stud_table.level  
    FROM students_diary.stud_table
    WHERE stud_table.id_group =" . $id_group);
    mysqli_close($connection);
    return $result;
}
function count_of_labs($level, $id_subject){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT subject_table.level". $level ." AS level  
    FROM students_diary.subject_table
    WHERE subject_table.id_subject=". $id_subject);
    mysqli_close($connection);
    return $result;
}

function student_marks_by_subject($id_student, $id_subject){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT marks_table.mark, marks_table.lab_num 
    FROM students_diary.marks_table
    WHERE marks_table.id_student=". $id_student ."
    AND marks_table.id_subject=". $id_subject);
    mysqli_close($connection);
    return $result;
}

function write_students_marks($id_subject, $id_student, $id_professor, $mark, $lab_num){
    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    $result = mysqli_query($connection, "INSERT INTO `students_diary`.`marks_table` (`id_subject`, `id_student`, `id_professor`, `mark`, `lab_num`) 
    VALUES (".$id_subject.", ".$id_student.", '". $id_professor ."', ".$mark.", ".$lab_num.");");
    mysqli_close($connection);
    return $result;
}

function latest_article_id() {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT MAX(id_article) AS id_article FROM students_diary.nwes_blog_table");
    mysqli_close($connection);
    return $result;
}

function article_all_data($id_article) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT * FROM students_diary.nwes_blog_table 
    WHERE id_article=".$id_article);
    mysqli_close($connection);
    return $result;
}


function subjects_id() {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT subject_table.name FROM `subject_table`");
    mysqli_close($connection);
    return $result;
}

function professors_edu_sub($id_subject) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT id_professor FROM `prof_table` WHERE id_subject =". $id_subject);
    mysqli_close($connection);
    return $result;
}


function about_prof($id_professor) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "SELECT `name`, `prof_photo`, `prof_level`, `prof_biography` 
    FROM `prof_table` 
    WHERE `id_professor` =". $id_professor);
    mysqli_close($connection);
    return $result;
}

function add_article_to_base($author, $date, $data, $article_head) {

    $connection = mysqli_connect('127.0.0.1','root','','students_diary');
        if ($connection==false) {
            echo "NOT OK";
    }
    mysqli_query($connection, "SET NAMES utf8");
    $result = mysqli_query($connection, "INSERT INTO `students_diary`.`nwes_blog_table` 
    (`author`, `date`, `data`, `article_head`, `pic_url`) 
    VALUES ('". $author ."', '". $date ."', '". $data ."', '". $article_head ."', 'news_img4.jpg')");
    mysqli_close($connection);
    return $result;
}
