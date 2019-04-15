<?php
if (isset($_POST["submit"])) {
//$nama=$_POST["nama"];
$tgl1 =$_POST["pinjam"]; //"20-12-2009";  // 1 Oktober 2009
$tgl2 =$_POST["kembali"]; //"29-12-2009";  // 10 Oktober 2009

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal pertama

$pecah1 = explode("-", $tgl1);
$date1 = $pecah1[0];
$month1 = $pecah1[1];
$year1 = $pecah1[2];

// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal kedua

$pecah2 = explode("-", $tgl2);
$date2 = $pecah2[0];
$month2 = $pecah2[1];
$year2 =  $pecah2[2];

// menghitung JDN dari masing-masing tanggal

$jd1 = GregorianToJD($month1, $date1, $year1);
$jd2 = GregorianToJD($month2, $date2, $year2);

// hitung selisih hari kedua tanggal

$selisih = $jd2 - $jd1;

echo "  Lama Peminjaman Maximal adalah <b> 3 hari </b><br>
        Anda Meminjam Selama : ".$selisih." hari<br>";
if (($selisih-3)<=0){
        echo "<b> Anda mengembalikan Tepat waktu !</b>";
        }else {
        $ahe=($selisih-3)*500;
        echo "Pengembalian Anda Telat <b>".($selisih-3)." Hari ! </b>Denda = $ahe";
        }
    exit();
    }

?>
<body>
<form method="POST"><table>
    <tr>
    <td>Tanggal Peminjaman : </td>
    <td>Tanggal Pengembalian : </td>
    </tr><tr>
    <td><input type="text" name="pinjam"></td>
    <td><input type="text" name="kembali"></td>
    </tr></table>
    <input type="submit" value="Hitung" name="submit" />
    <br>* Format tanggal (tanggal-bulan-tahun) ex= 26-12-2010
</form>
</body>