<?php
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";

# SKRIP MEMBACA DATA TRANSAKSI 
if(isset($_GET['Kode'])){
	$Kode = $_GET['Kode'];
	
	// Skrip membaca data dari tabel peminjaman
	$mySql = "SELECT peminjaman.*, users.level, siswa.nm_siswa FROM peminjaman
				LEFT JOIN users ON peminjaman.username=users.username 
				LEFT JOIN siswa ON peminjaman.nisn = siswa.nisn
				WHERE no_pinjam='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql)  or die ("Query salah : ".mysqli_error());
	$myData = mysqli_fetch_array($myQry);
}
else {
	echo "Nomor Pinjam (Kode) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Pinjam </title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">

<h2> PERPUSTAKAN SMKN 2 Kota Bekasi </h2>


<table width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="120"><strong>No. Pinjam </strong></td>
    <td width="10">:</td>
    <td width="448"> <?php echo $myData['no_pinjam']; ?></td>
  </tr>
  <tr>
    <td><strong>Tgl. Pinjam </strong></td>
    <td>:</td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
  </tr>
  <tr>
    <td><strong>Siswa</strong></td>
    <td>:</td>
    <td> <?php echo $myData['nm_siswa']; ?> </td>
  </tr>
  <tr>
    <td><strong>Tanggal Kembali </strong></td>
    <td>:</td>
    <td> <?php echo $myData['tgl_kembali']; ?> </td>
  </tr>
  
  <tr>
    <td><strong>Status</strong></td>
    <td>:</td>
    <td> <?php echo $myData['status']; ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="40" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="451" bgcolor="#CCCCCC"><strong>Judul Buku </strong></td>
    
  </tr>
<?php
$totalPinjam	= 0;
// Menampilkan daftar Buku pinjaman
$notaSql = "SELECT peminjaman_detil.*, buku.judul FROM peminjaman_detil
			LEFT JOIN buku ON peminjaman_detil.kd_buku = buku.kd_buku 
			WHERE peminjaman_detil.no_pinjam='$Kode'
			ORDER BY buku.kd_buku ASC";
$notaQry = mysqli_query($koneksidb, $notaSql)  or die ("Query list salah : ".mysqli_error());
$nomor  = 0;  
while ($notaData = mysqli_fetch_array($notaQry)) {
	$nomor++;
	//$totalPinjam	= $totalPinjam + $notaData['jumlah'];
?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $notaData['kd_buku']; ?> </td>
    <td> <?php echo $notaData['judul']; ?> </td>

  </tr>
<?php } ?>
</table>
</body>
</html>
