<?php
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
     include "config/fungsi_terlambat.php";
    include "config/inc.connection.php";
    $aksi = "modul/mod_datapinjam/aksi_datapinjam.php";   
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     $lambat=isset($_GET['lambat']) ? $_GET['lambat'] :'';
     //include "config/fungsi_terlambat.php";
     switch($act){
         default:
               echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=datapinjam\">Data Peminjaman</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Pinjam Buku</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>No Pinjam</th>
        <th>Tgl.Pinjam</th>
        <th>Tgl.Kembali</th>
        <th>Peminjam</th>
        <th>Status</th>
        <th>Terlambat</th>
        <th>Aksi</th> 
    </tr>
    </thead>
    <tbody>"; 
    
   $query  =mysqli_query($koneksidb,"SELECT siswa.nm_siswa,peminjaman.no_pinjam,peminjaman.status,peminjaman.tgl_pinjam,peminjaman.tgl_kembali FROM peminjaman, siswa WHERE peminjaman.nisn=siswa.nisn AND  status='Pinjam' ORDER BY no_pinjam");
   //$tampil = mysql_query($query,$koneksidb);
    $no = 1;
    while ($tyo = mysqli_fetch_array($query)):
         $Kode = $tyo['no_pinjam'];
         echo "<tr><td>$no</td>
             <td>$tyo[no_pinjam]</td>
             <td>$tyo[tgl_pinjam]</td>
             <td>$tyo[tgl_kembali]</td>
             <td>$tyo[nm_siswa]</td>
             <td>$tyo[status]</td>
             <td>";
   
                $tgl_dateline=$tyo['tgl_kembali'];
		$tgl_kembali=date('Y-m-d');
		$lambat=terlambat($tgl_dateline, $tgl_kembali);
		$denda=$lambat*$denda1;
		if ($lambat>0) {
		echo "<font color='red'>$lambat hari<br>(Rp $denda)</font>";
		}
		else {
		echo $lambat." hari";
		}
            
        echo "     </td>      
                   <td>
            <a class=\"btn btn-info btn-xs\" href=\"$aksi?module=datapinjam&act=kembali&no_pinjam=$tyo[no_pinjam]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Kembali
            </a>
            <a class=\"btn btn-danger btn-xs\" href=\"$aksi?module=datapinjam&act=panjang&no_pinjam=$tyo[no_pinjam]&kembali=$tyo[tgl_kembali]&lambat=$lambat\" >
                <i class=\"glyphicon glyphicon-delete icon-white\"></i>
                Perpanjang
            </a>
            <a class=\"btn btn-warning btn-xs\" target=\"_blank\" href=\"cetak/daftarbuku.php?Kode=$Kode\" >
                <i class=\"glyphicon glyphicon-delete icon-white\"></i>
                List
            </a>
                   </td>    
             </tr>";
       $no++; 
   endwhile;
        echo "</tbody></table>
       </div><!-- box content -->
       </div><!--box inner -->
       </div><!--box col-md-12 -->
       </div><!-- row -->";
        
   
        break;

    

    }
}

