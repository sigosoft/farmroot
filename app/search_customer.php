<?php
    $key=$_GET['key'];
    $array = array();
    require 'db/config.php';
    $query=mysqli_query($conn,"SELECT * FROM verifed_register WHERE Register_Name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Register_Name'];
    }
    echo json_encode($array);
?>