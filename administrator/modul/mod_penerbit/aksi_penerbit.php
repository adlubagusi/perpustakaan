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
    
    //hapus data penerbit
    if($module=='penerbit' AND $act=='hapus'){
        $delete = "DELETE FROM penerbit WHERE kd_penerbit='$_GET[kd_penerbit]'";
        mysqli_query($koneksidb, $delete);
        header("location:../../media.php?module=".$module);
    }
    
    //input data penerbit
    elseif($module=='penerbit' AND $act=='input'){
        $nm_penerbit = $_POST['nm_penerbit'];
        $kodeBaru = buatKode("penerbit", "P");
        
        $input = "INSERT penerbit SET kd_penerbit = '$kodeBaru',
                                      nm_penerbit = '$nm_penerbit'";
        mysqli_query($koneksidb, $input);
        header("location:../../media.php?module=".$module);
    }
    
    //update data penerbit
    elseif($module=='penerbit' AND $act=='update'){
        $nm_penerbit = $_POST['nm_penerbit'];
        $Kode = $_POST['Kode'];
        
        $update = "UPDATE penerbit SET nm_penerbit = '$nm_penerbit'
                                  WHERE kd_penerbit = '$Kode'";
        mysqli_query($koneksidb, $update);
        header("location:../../media.php?module=".$module);
    }
}