<?php
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo "<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
        <link href=\"../css/error.css\" rel='stylesheet' type=\"text/css\" />
<p class=\"error-code\">
    404
</p>

<p class=\"not-found\">Not<br/>Found</p>

<div class=\"clear\"></div>
<div class=\"content\">
    The page your are looking for is not found.
    <br>
    <a href=\"index.php\">Go Back</a>
    or
    <br>
    <br>
</div>";
}
else {
    

include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$no_daftar= isset($_GET['no_daftar']) ?  $_GET['no_daftar'] : ''; 
	
	# Membaca data dari tabel Pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				WHERE pendaftaran.no_daftar='$no_daftar'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Pendaftaran Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Antrian Pendaftaran Charisma Hospital</title>
<link href="../css/printer.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onload="window.print()">
<h2> ANTRIAN PENDAFTARAN </h2>
<table width="400" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="35%"><strong>No Daftar </strong></td>
	  <td width="5%"><strong>:</strong></td>
	  <td width="60%"><?php echo $myData['no_daftar']; ?></td>
	</tr>
	<tr>
	  <td><strong>Nomor RM </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nomor_rm']; ?></td>
    </tr>
	<tr>
      <td><strong>Nama Pasien </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_pasien']; ?></td>
  </tr>
	<tr>
	  <td><strong>Tgl.  Daftar </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
    </tr>
	<tr>
	  <td><strong>Tgl.  &amp; Jam Janji </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo IndonesiaTgl($myData['tgl_janji']);  ?>, 
	  	  <?php echo $myData['jam_janji']; ?></td>
    </tr>
	<tr>
	  <td><strong>Keluhan Pasien </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['keluhan']; ?></td>
	</tr>
	<tr>
	  <td><strong>Tindakan Pasien </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_tindakan']; ?></td>
    </tr>
	<tr>
      <td><strong>Nomor Antrian </strong></td>
	  <td><strong>:</strong></td>
	  <td><h1><?php echo $myData['nomor_antri']; ?></h1></td>
    </tr>
</table>
</form>
<footer><?php echo "Herry Prasetyo"; ?> </footer>
<?php } ?>