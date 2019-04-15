<?php
$tgl_kembali = "2017-07-12";
$pecah		= explode("-",$tgl_kembali);
$next_3_hari	= mktime(0,0,$pecah[0],$pecah[1],$pecah[2]+3);
//echo "$next_3_hari";
$hari_next	= date("Y-m-d", $next_3_hari);
 //echo $pecah[0],$pecah[1],$pecah[2]+'3';
echo $hari_next;