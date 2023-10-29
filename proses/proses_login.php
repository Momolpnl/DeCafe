<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include "connect.php";
    $username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : "";
    $password = (isset($_POST['password'])) ? md5(htmlspecialchars($_POST['password'])) : "";

    if (!empty($_POST["submit_validate"])) {
        $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' && password =            
        '$password'");
        $hasil = mysqli_fetch_array($query);
        if($hasil){
            $_SESSION['username_decafe'] = $username;
            $_SESSION['level_decafe'] = $hasil['hasil'];
            header('location:../home');
        }else{?>
        <script>
            alert("username atau password yang anda masukan salah");
            window.location='../login'
        </script>
<?php
        }
    }
?>
