<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id'] ): "";
$name = (isset($_POST['nama'])) ? htmlspecialchars($_POST['nama'] ): "";
$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlspecialchars($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlspecialchars($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlspecialchars($_POST['alamat']) : "";
$password = md5('password');
$message = ""; // Variabel $message didefinisikan di sini

if(!empty($_POST['input_user_validate'])){
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada")
        window.location="../user"</script>';
    } else {
    $query = mysqli_query($conn, "UPDATE tb_user SET nama='$name', username='$username', level='$level', nohp='$nohp', alamat='$alamat' WHERE id='$id'");
    if($query){
        $message = '<script>alert("Data berhasil diupdate")
                    window.location="../user"</script>';
    }else{
        $message = '<script>alert("Data gagal diupdate")
                    window.location="../user"</script>';
    }}
}echo $message;
?>