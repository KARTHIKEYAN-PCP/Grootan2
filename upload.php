<?php

if(isset($_POST['submit']))
{
   
   $file = $_FILES['file']['tmp_name'];

    $sql[] = array();
    $handle = fopen($file, "r");

    $header = fgetcsv($handle,1000,",");
    if($header){
        $header_sql = array();
        foreach($header as $h){
            $header_sql[] = '`'.$h.'` VARCHAR(255)';
        }
        $sql[] = 'CREATE TABLE `Data_base` ('.implode(',',$header_sql).')';

        while($data = fgetcsv($handle,1000,",")){   
            $sql[] = "INSERT INTO data VALUES ('".implode("','",$data)."')";
        }
    }        

    $con = mysqli_connect('localhost','root','','GOG');
    foreach($sql as $s){
        mysqli_query($s,$con);
    }
}
?>