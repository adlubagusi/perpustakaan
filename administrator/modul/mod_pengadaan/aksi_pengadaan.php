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
    Ada yang salah di codingnya nih
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
    
     //hapus data
    if($module=='pengadaan' AND $act=='hapus'){
        $delete = "DELETE FROM pengadaan WHERE no_pengadaan ='$_GET[no_pengadaan]'";
        mysqli_query($koneksidb, $delete);
        header("location:../../media.php?module=".$module);
    }
    
    //input data 
    elseif($module=='pengadaan' AND $act=='input'){
        $kodeBaru = buatKode("pengadaan","PG");
        $tgl_pengadaan = $_POST['tgl_pengadaan'];
        $buku = $_POST['buku'];
        $asal_buku = $_POST['asal_buku'];
        $jumlah = $_POST['jumlah'];
        $keterangan = $_POST['keterangan'];
        
        $input = "INSERT pengadaan SET no_pengadaan = '$kodeBaru',
                                       tgl_pengadaan = '$tgl_pengadaan',
                                       kd_buku ='$buku', 
                                       asal_buku = '$asal_buku',
                                       jumlah = '$jumlah', 
                                       keterangan = '$keterangan'";
        mysqli_query($koneksidb, $input);
        header("location:../../media.php?module=".$module);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
}

