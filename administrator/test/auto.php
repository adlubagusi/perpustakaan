<?php
include_once ('../config/inc.connection.php');

//$q = trim(strip_tags($_GET['term'])); // variabel $q untuk mengambil inputan user
$q = $_GET['term'];
$sql = mysql_query("SELECT * FROM pasien WHERE nomor_rm LIKE '%".$q."%'"); // menampilkan data yg ada didatabase yg sesuai dengan inputan user
while ($data = mysql_fetch_array($sql)){
	//$result[] = htmlentities(stripslashes($data['nm_jabatan_eks'])); // manempilkan nama jabatan
		
		
		$row['value']	=$data['nomor_rm'];
		$row['nm_pasien']	=$data['nm_pasien'];
		$row_set[]		=$row;
}
//echo json_encode($result);
echo json_encode($row_set);
?>