<?php
include "connect.php";
$name_menu = (isset($_POST['nama_menu'])) ? htmlspecialchars($_POST['nama_menu'] ): "";
$keterangan = (isset($_POST['keterangan'])) ? htmlspecialchars($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlspecialchars($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlspecialchars($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlspecialchars($_POST['stok']) : "";

$kode_random = rand(10000, 99999)."-";
$target_dir = "../assets/img/".$kode_random;
$target_file = $target_dir.basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!empty($_POST['input_menu_validate'])){
// cek apakah gambar atau bukan
$cek = getimagesize($_FILES['foto']['tmp_name']);
if ($cek == false){
    $message = "ini bukan file gambar";
    $statusUpload = 0;
}else{
    $statusUpload = 1;
    if(file_exists($target_file)){
        $message = "Maaf file yang dimasukan telah ada";
        $statusUpload = 0;
    }if ($_FILES['foto']['size'] > 500000) { //500kb
        $message = "file foto yang diupload terlalu besar";
        $statusUpload = 0;
    } else {
        if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
            $message = "maaf hanya diperbolehkan gambar yang memiliki format JPG, PNG, JPEG dan GIF";
            $statusUpload = 0;
        }
    }
    
    }
if ($statusUpload == 0) {
    $message = '<script>alert("' . $message . ', Gambar Tidak Dapat Diupload"); window.location="../menu"</script>';
} else {
    $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$name_menu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Nama Menu Yang dimasukan Telah Ada"); window.location="../menu"</script>';
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $query = mysqli_query($conn, "INSERT INTO tb_daftar_menu (foto,nama_menu,keterangan,kategori,harga,stok) 
            VALUES ('".$kode_random. $_FILES['foto']['name'] . "', '$name_menu','$keterangan','$kat_menu','$harga','$stok')");
            if ($query) {
                $message = '<script>alert("Data berhasil dimasukan"); window.location="../menu"</script>';
            }else{
                $message = '<script>alert("Data Gagal dimasukan"); window.location="../menu"</script>';
            }
        }else{
            $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload"); window.location="../menu"</script>';
        }
    }
}
}
echo $message;
?>