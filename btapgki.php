<?php
$severname ="localhost";
$username = "root";
$password = "";
$database="QLSV_NguyenHuuHuy";
$conn =new mysqli($severname, $username , $password , $database);
if(!$conn){
    die("Kết nối thất bại!!!");
}else{
    echo"Kết nối thành công";
}

?>