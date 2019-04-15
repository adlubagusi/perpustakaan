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
    include "../../config/excel_reader2.php";
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    //upload data 
    if($module=='siswa' AND $act=='input'){
        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']); 
        
        //membaca jumlah baris excel 
        $baris = $data->rowcount($sheet_index=0);
        
        //nilai awal counter untuk jumlah data yang sukses dan yang gagal import 
        $sukses = 0; 
        $gagal = 0; 
        
        //import data excel mulai baris ke 2 
        for($i=2; $i<=$baris; $i++){
            //membaca data nisn
            $nisn = $data->val($i, 1);
            $nm_siswa = $data->val($i, 2);
            $kelamin = $data->val($i, 3);
            $kelas = $data->val($i, 4);
            $tempat_lahir = $data->val($i, 5);
            
            //simpan data ke dalam database 
            $hasil = mysqli_query($koneksidb,"INSERT siswa SET nisn='$nisn',
                                                   nm_siswa='$nm_siswa', 
                                                   kelamin = '$kelamin', 
                                                   kelas = '$kelas', 
                                                   tempat_lahir = '$tempat_lahir'");
            if($hasil)
                $sukses++;
            else
                $gagal++;
            
        }
      header("location:../../media.php?module=".$module);      
    }
    
    //input manual 
    elseif($module=='siswa' AND $act=='inputsiswa'){
        $nisn = $_POST['nisn'];
        $nm_siswa = $_POST['nm_siswa'];
        $kelamin = $_POST['kelamin'];
        $tempat_lahir = $_POST['tempat_lahir']; 
        $kelas=$_POST['kelas'];
        
        $input_siswa = "INSERT siswa SET nisn       = '$nisn',
                                         nm_siswa = '$nm_siswa', 
                                         kelamin    = '$kelamin', 
                                         kelas      = '$kelas',
                                         tempat_lahir  ='$tempat_lahir'";
        
        mysqli_query($koneksidb, $input_siswa)or die("gagal simpan".mysqli_error());
        header("location:../../media.php?module=".$module);
        
    }
    
    elseif($module=='siswa' AND $act=='hapus'){
        $delete  = "DELETE FROM siswa WHERE nisn='$_GET[nisn]'";
        mysqli_query($koneksidb, $delete);
        header("location:../../media.php?module=".$module);
    }
    
    elseif($module=='siswa' AND $act=='update'){
        $nisn = $_POST['nisn'];
        $nm_siswa = $_POST['nm_siswa'];
        $kelas   = $_POST['kelas'];
        $kelamin = $_POST['kelamin'];
        $tempat_lahir = $_POST['tempat_lahir'];
        
        $update = "UPDATE siswa SET nm_siswa = '$nm_siswa', 
                                    kelas = '$kelas', 
                                    kelamin = '$kelamin', 
                                    tempat_lahir='$tempat_lahir' 
                        WHERE nisn = '$nisn'";
        mysqli_query($koneksidb, $update);
        header("location:../../media.php?module=".$module);
    }
}
?>