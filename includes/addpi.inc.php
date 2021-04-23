<?php 
    session_start();  
    include_once 'dbh.inc.php';
?>

<?php
    
    include_once 'dbh.inc.php';

    $pi_position = $_POST['pi_position'];
    $req_id = $_POST['req_id'];
    $req_project_id = $_POST['req_project_id'];

    $sql = "CALL add_pi('$pi_position','$req_id','$req_project_id')";
    mysqli_query($conn, $sql);
    

    header("Location: ../index6.php?add_PI=success");