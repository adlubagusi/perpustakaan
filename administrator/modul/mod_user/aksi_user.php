<?php 
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
     echo "<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
        <link href=\"../../css/error.css\" rel='stylesheet' type=\"text/css\" />
<p class=\"error-code\">
    404
</p>

<p class=\"not-found\">Not<br/>Found</p>

<div class=\"clear\"></div>
<div class=\"content\">
    The page your are looking for is not found.
    <br>
    <a href=\"index.php\">Go Back</a>
    
    <br>
    <br>
</div>";
}
else{
    include "../../config/inc.connection.php";
    
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    if($module=='user' AND $act=='input'){
        $username = $_POST['username'];
        $password = md5($_POST['password']); 
        $email = $_POST['email'];
        $nama_lengkap = $_POST['nama_lengkap'];
        
        $input = "INSERT users SET username ='$username',
                                   nama_lengkap = '$nama_lengkap', 
                                   email = '$email', 
                                   password = '$password'";
        mysqli_query($koneksidb, $input);
        header("location:../../media.php?module=".$module);
    }
    
    elseif($module=='user' AND $act =='update') {
           $id = $_POST['id'];
           $nama_lengkap = $_POST['nama_lengkap'];
           $email = $_POST['email'];
           $blokir = $_POST['blokir'];
           $level = $_POST['level'];
           $password = $_POST['password'];
           
           //apabila password tidak di ubah 
           if(empty($password)){
               $update = "UPDATE users SET nama_lengkap ='$nama_lengkap', "
                                        . "email = '$email',"
                                        . "blokir = '$blokir',"
                                        . "level = '$level'"
                                        . "WHERE id_session = '$id'";
               mysqli_query($koneksidb, $update);
           }
           else{
               $password = md5($_POST['password']);
                $update = "UPDATE users SET nama_lengkap = '$nama_lengkap',
                                                  email  = '$email',
                                                  blokir = '$blokir',
                                                  level = '$level',
                                                password = '$password'    
                                        WHERE id_session = '$id'";
      mysqli_query($koneksidb, $update)or die("Gagal Update".mysqli_error());
           }
      header("location:../../media.php?module=".$module);
    }
    
    
}

