<?php
# Membaca form filter Siswa
$kodeSiswa 	= isset($_POST['cmbSiswa']) ? $_POST['cmbSiswa'] : 'Semua'; 

# Membuat Filter Siswa
if($kodeSiswa=="Semua") {
	// Jika memilih siswa
	$filterSQL = "";
}
else {
	$filterSQL = "WHERE peminjaman.nisn ='$kodeSiswa'";
}

?>
<h2> LAPORAN PEMINJAMAN PER SISWA </h2>

<form id="form1" name="form1" method="post" action="">
  <table width="500" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84">Siswa</td>
      <td width="401">:	  
		<select data-rel="chosen" name="cmbSiswa">
		<option value="Semua">....</option>
		<?php
		// Skrip menampilkan data Siswa ke ComboBo (ListMenu)
		$bacaSql = "SELECT * FROM siswa ORDER BY nisn";
		$bacaQry = mysqli_query($koneksidb,$bacaSql) or die ("Gagal Query".mysql_error());
		while ($bacaData = mysqli_fetch_array($bacaQry)) {
			if ($bacaData['nisn'] == $kodeSiswa) {
				$cek = " selected";
			} else { $cek=""; }
			
			echo "<option value='$bacaData[nisn]' $cek> $bacaData[nisn] - $bacaData[nm_siswa]</option>";
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
$myQry = mysqli_query($koneksidb,$mySql)  or die ("Query salah : ".mysql_error());
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
