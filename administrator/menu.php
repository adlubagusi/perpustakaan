<?php 
    include "config/inc.connection.php";
    if($_SESSION['leveluser']=='admin'){
        $query = "SELECT * FROM modul WHERE aktif = 'Y' ORDER BY urutan";
        $hasil = mysqli_query($koneksidb,$query);
        while($tyo =mysqli_fetch_array($hasil)){
            echo "<li><a class=\"ajax-link\" href=\"$tyo[link]\"><i class=\" glyphicon glyphicon-th-list\"></i><span> $tyo[nama_modul]</span></a>";
        }
    }
  elseif($_SESSION['leveluser']=='user'){
  $query = "SELECT * FROM modul WHERE status='user' and aktif='Y' ORDER BY urutan";
  $hasil = mysqli_query($koneksidb,$query);
  while ($m=mysql_fetch_array($hasil)){  
    echo "<li><a class=\"ajax-link\" href=\"$m[link]\"><i class=\" glyphicon glyphicon-th-list\"></i><span> $m[nama_modul]</span></a>";
  }
} 
?>