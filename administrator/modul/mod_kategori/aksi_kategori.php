<?php
session_start(); 
if(empty($_SESSSION['namauser']) AND empty($_SESSION['passuser'])){
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
    include "../../config/inc.library.php";
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    //hapus data kategori
    if($module=='kategori' AND $act=='hapus'){
        $delete = "DELETE FROM kategori WHERE kd_kategori='$_GET[kd_kategori]'";
        mysqli_query($koneksidb, $delete);
        header("location:../../media.php?module=".$module);
    }
    
    //input data kategori
    elseif($module=='kategori' AND $act=='input'){
        $nm_kategori = $_POST['nm_kategori'];
        $kodeBaru = buatKode("kategori", "K");
        
        $input = "INSERT kategori SET kd_kategori = '$kodeBaru',
                                      nm_kategori = '$nm_kategori'";
        mysqli_query($koneksidb, $input);
        header("location:../../media.php?module=".$module);
    }
    
    //update data kategori
    elseif($module=='kategori' AND $act=='update'){
        $nm_kategori = $_POST['nm_kategori'];
        $Kode = $_POST['Kode'];
        
        $update = "UPDATE kategori SET nm_kategori = '$nm_kategori'
                                  WHERE kd_kategori = '$Kode'";
        mysqli_query($koneksidb, $update);
        header("location:../../media.php?module=".$module);
    }
}