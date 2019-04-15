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
    $module = $_GET['module'];
    $act = $_GET['act'];
    $lambat= $_GET['lambat'];
    $tgl_kembali= $_GET['kembali'];
    //fungsi untuk mengambalikan buku 
    if($module=='datapinjam' AND $act=='kembali'){
        $kembali ="UPDATE peminjaman SET status ='Kembali' WHERE no_pinjam='$_GET[no_pinjam]'";
        mysqli_query($koneksidb, $kembali);
        header("location:../../media.php?module=".$module);
    }
    
    elseif($module=='datapinjam' AND $act=='panjang'){
        if($lambat > 3){
            echo "<script>alert('Buku yang dipinjam tidak dapat diperpanjang, karena sudah terlambat lebih dari 3 hari. Kembalikan dahulu, kemudian pinjam kembali, NGERTI GA LO !');</script>";
            echo "<meta http-equiv='refresh' content='0; url=http://localhost/perpustakaan_ari/administrator/media.php?module=datapinjam'>";
        //header("location:../../media.php?module=".$module);
        }
        else{
         /*   
        $pecah		= explode("-",$tgl_kembali);
	$next_3_hari	= mktime(0,0,0,$pecah[0],$pecah[1],$pecah[2]);
	$hari_next	= date("Y-m-d", $next_3_hari);
        */
        $pecah		= explode("-",$tgl_kembali);
        $next_3_hari	= mktime(0,0,$pecah[0],$pecah[1],$pecah[2]+3);
    //echo "$next_3_hari";
    $hari_next	= date("Y-m-d", $next_3_hari);
    //echo $pecah[0],$pecah[1],$pecah[2]+'3';

	$update_tgl_kembali=mysqli_query($koneksidb,"UPDATE peminjaman SET tgl_kembali='$hari_next' WHERE no_pinjam='$_GET[no_pinjam]'");
        if ($update_tgl_kembali) {
		echo "<script>alert('Berhasil diperpanjang....');</script>";
		echo "<meta http-equiv='refresh' content='0; url=http://localhost/perpustakaan_ari/administrator/media.php?module=datapinjam'>";
	} else {
		echo "<script>alert('Gagal diperpanjang');</script>";
		echo "<meta http-equiv='refresh' content='0; url=http://localhost/perpustakaan_ari/administrator/media.php?module=datapinjam'>";
	}    
        }
        
    }
}
