<?php
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlspecialchars($_POST['nama'] ): "";
$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlspecialchars($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlspecialchars($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlspecialchars($_POST['alamat']) : "";
$password = md5('password');
$message = ""; // Variabel $message didefinisikan di sini

if (!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn, "INSERT INTO tb_user (nama,username,level,nohp,alamat,password) values ('$name','$username','$level','$nohp','$alamat','$password')");
    If (!$query){
        $message = '<script>alert("Data gagal dimasukkan")</script>';
    }else{
        $message = '<script>alert("Data berhasil dimasukkan");
        window.location="../user"</script>
        </script>';
    }
}echo $message;
?>
