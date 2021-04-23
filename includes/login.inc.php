<?php
    
    include_once 'dbh.inc.php';

    $faculty_id = $_POST['faculty_id'];
    $passwd = $_POST['passwd'];
    

    $sql3 = "SELECT postion FROM faculty WHERE id = '$faculty_id';";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $a = $row3['position'];

    if($pos1 == 3){
        header("Location: ../directorhome.php?add_fellow=success");
    }
    

    