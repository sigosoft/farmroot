<?php
    $key=$_GET['key'];
    $array = array();
    require 'db/config.php';
    $query=mysqli_query($conn,"SELECT * FROM products WHERE PsearchName LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['PsearchName'];
    }
    echo json_encode($array);
?>