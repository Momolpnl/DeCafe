<?php
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlspecialchars($_POST['nama'] ): "";
$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlspecialchars($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlspecialchars($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlspecialchars($_POST['alamat']) : "";
$password = md5('password');

if (!empty($_POST['input_user_validate'])){
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_num_rows($select) > 0){
        $message = '<script>alert("Username yang dimasukkan telah ada");
        window.location="../user"</script>';
    }else{
    $query = mysqli_query($conn, "INSERT INTO tb_user (nama,username,level,nohp,alamat,password) values ('$name','$username','$level','$nohp','$alamat','$password')");
    if ($query){
        $message = '<script>alert("Data berhasil dimasukan");
        window.location="../user"</script>';
    }else{
        $message ='<script>alert("Data gagal dimasukan")</script>';
    }
}
}echo $message;
?>
