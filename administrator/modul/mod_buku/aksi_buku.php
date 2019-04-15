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
    
     include "../../config/fungsi_thumbnail.php";
     include "../../config/inc.library.php";
     
     $module = $_GET['module'];
     $act = $_GET['act'];
     
     if($module=='buku' AND $act=='hapus'){
         $query = "SELECT gambar FROM buku WHERE kd_buku = '$_GET[kd_buku]'";
         $hapus = mysqli_query($koneksidb, $query);
         $r = mysqli_fetch_array($hapus);
         
         if($r['gambar']!=''){
             $namafile = $r['gambar']; 
             unlink("../../../foto_buku/$namafile");
             unlink("../../../foto_buku/small_$namafile");
             
             //hapus data buku dari database 
             mysqli_query($koneksidb, "DELETE FROM buku WHERE kd_buku = '$_GET[kd_buku]'");
         }
         else{
             mysqli_query($koneksidb, "DELETE FROM buku WHERE kd_buku = '$_GET[kd_buku]'");
         }
         header("location:../../media.php?module=".$module);
     }
     
     else if($module=='buku' AND $act=='input'){
       $lokasifile = $_FILES['fupload']['tmp_name'];
       $tipe_file  = $_FILES['fupload']['type'];
       $nama_file = $_FILES['fupload']['name'];
       $acak = rand(1, 99); 
       $nama_gambar = $acak.$nama_file;
         
        $kodeBaru   = buatKode("buku","B");
        $judul      = $_POST['judul']; 
        $pengarang  = $_POST['pengarang'];
        $isbn       = $_POST['isbn'];
        $halaman    = $_POST['halaman'];
        $jumlah     = $_POST['jumlah'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $sinopsis   = $_POST['sinopsis'];
        $penerbit   = $_POST['penerbit'];
        $kategori   = $_POST['kategori'];
       
        if(empty($lokasi_file)){
            $input = "INSERT buku SET kd_buku = '$kodeBaru', 
                                      judul = '$judul', 
                                      pengarang = '$pengarang', 
                                      isbn = '$isbn', 
                                      halaman = '$halaman',
                                      jumlah = '$jumlah', 
                                      th_terbit = '$tahun_terbit', 
                                      sinopsis = '$sinopsis',
                                      kd_penerbit = '$penerbit', 
                                      kd_kategori = '$kategori'";
            mysqli_query($koneksidb, $input); 
            header("location:../../media.php?module=".$module);
        }
        else{
            if($tipe_file !="image/jpeg" AND $tipe_file !="image/pjpeg"){
                echo "<script>window.alert('Upload Gagal! Pastikan file yang di upload bertipe *.JPG');
              window.location=('../../media.php?module=buku')</script>";
            }
            else{
                $folder = "../../../foto_buku/";
                $ukuran = 200;
                UploadFoto($nama_gambar,$folder,$ukuran);
                mysqli_query($koneksidb,"INSERT buku SET kd_buku = '$kodeBaru', 
                                      judul = '$judul', 
                                      pengarang = '$pengarang', 
                                      isbn = '$isbn', 
                                      halaman = '$halaman',
                                      jumlah = '$jumlah', 
                                      th_terbit = '$tahun_terbit', 
                                      sinopsis = '$sinopsis', 
                                      gambar = '$nama_gambar',
                                      kd_penerbit = '$penerbit', 
                                      kd_kategori = '$kategori'");
            //mysql_query($input,$koneksidb); 
            header("location:../../media.php?module=".$module);
            }
        }
     }
     
     //update buku 
     elseif($module=='buku' AND $act=='update'){
        $judul      = $_POST['judul']; 
        $pengarang  = $_POST['pengarang'];
        $isbn       = $_POST['isbn'];
        $halaman    = $_POST['halaman'];
        $jumlah     = $_POST['jumlah'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $sinopsis   = $_POST['sinopsis'];
        $penerbit   = $_POST['penerbit'];
        $kategori   = $_POST['kategori'];
        $Kode = $_POST['Kode'];
        
        $update = "UPDATE buku SET    judul ='$judul',
                                      pengarang = '$pengarang', 
                                      isbn = '$isbn', 
                                      halaman = '$halaman',
                                      jumlah = '$jumlah', 
                                      th_terbit = '$tahun_terbit', 
                                      sinopsis = '$sinopsis',
                                      kd_penerbit = '$penerbit', 
                                      kd_kategori = '$kategori'
                            WHERE kd_buku = '$Kode'";
        mysqli_query($koneksidb, $update);
        header("location:../../media.php?module=".$module); 
     }
}
?>