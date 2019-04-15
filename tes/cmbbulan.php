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