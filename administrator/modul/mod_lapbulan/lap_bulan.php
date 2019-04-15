<?php
include "config/inc.connection.php";
//include "config/inc.library.php";
include "config/inc.pilihan.php";

// Membaca nama form
$dataBulan 	= isset($_POST['cmbBulan']) ? $_POST['cmbBulan'] : date('m'); 
$dataTahun 	= isset($_POST['cmbTahun']) ? $_POST['cmbTahun'] : date('Y'); 

# Membuat Filter Bulan
if($dataTahun and $dataBulan) {
	$filterSQL = "WHERE LEFT(tgl_pinjam,4)='$dataTahun' AND MID(tgl_pinjam,6,2)='$dataBulan'";
}
else {
	$filterSQL = "";
}

?>
<h2> LAPORAN PEMINJAMAN PER BULAN</h2>

<form id="form1" name="form1" method="post" action="">
  <table width="500" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="133">Bulan / Tahun </td>
      <td width="352">: 
		<select name="cmbBulan">
		<?php
		for($bulan = 1; $bulan <= 12; $bulan++) {
			// Skrip membuat angka 2 digit (1-9)
			if($bulan < 10) { $bln = "0".$bulan; } else { $bln = $bulan; }
			
			if ($bln == $dataBulan) { $cek=" selected"; } else { $cek = ""; }
			
			echo "<option value='$bln' $cek> $listBulan[$bln] </option>";
		}
		?>
		</select>
		<select name="cmbTahun">
		  <?php
			$$awal_th= date('Y') - 3;
		  for($tahun = $$awal_th; $tahun <= date('Y'); $tahun++) {
			// Skrip tahun terpilih
			if ($tahun == $dataTahun) {  $cek=" selected"; } else { $cek = ""; }
			
			echo "<option value='$tahun' $cek> $tahun </option>";
		  }
		  ?>
		</select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" id="btnTampil" value="Tampil" /></td>
    </tr>
  </table>
</form>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="85" bgcolor="#CCCCCC"><strong>No. Pinjam </strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>Tgl. Pinjam </strong></td>
    <td width="207" bgcolor="#CCCCCC"><strong>Siswa</strong></td>
    
    <td width="45" bgcolor="#CCCCCC"><strong>Status</strong></td>
  </tr>
  
<?php 
// Skrip menampilkan data Peminjaman dengan filter Bulan
$mySql = "SELECT peminjaman.*, siswa.nisn, siswa.nm_siswa FROM peminjaman 
			LEFT JOIN siswa ON peminjaman.nisn = siswa.nisn
			$filterSQL ORDER BY peminjaman.no_pinjam ASC";
$myQry = mysqli_query( $koneksidb,$mySql)  or die ("Query salah : ".mysql_error());
$nomor = 0;  
while ($myData = mysqli_fetch_array($myQry)) {
	$nomor++;		
?>

  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['no_pinjam']; ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
    <td> <?php echo $myData['nisn']."/ ".$myData['nm_siswa']; ?> </td>
    
    <td> <?php echo $myData['status']; ?> </td>
  </tr>

<?php } ?>
</table>
