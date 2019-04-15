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
     $aksi = "modul/mod_penerbit/aksi_penerbit.php";   
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     $dataKode = buatKode("penerbit", "P");
     switch($act){
         default:
               echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=penerbit\">Data Penerbit</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Penerbit</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=penerbit&act=tambahpenerbit\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Nama Penerbit</th>
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM penerbit";
   $tampil = mysqli_query($koneksidb,$query);
    $no = 1;
    while ($tyo = mysqli_fetch_array($tampil)):
         
         echo "<tr><td>$no</td>
             <td>$tyo[nm_penerbit]</td>
             
            ";
        echo "           
                   <td>
            <a class=\"btn btn-info\" href=\"?module=penerbit&act=editpenerbit&kd_penerbit=$tyo[kd_penerbit]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=penerbit&act=hapus&kd_penerbit=$tyo[kd_penerbit]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI..?')\">
                <i class=\"glyphicon glyphicon-delete icon-white\"></i>
                Delete
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


    case "tambahpenerbit":
            echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=penerbit\">Data Penerbit</a>
            </li>
        </ul>
    </div>";
    //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Penerbit</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=penerbit&act=input\">
                    <div class=\"form-group\">
                        <label>Kode Penerbit</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_penerbit\" placeholder=\"Kode Penerbit\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Penerbit</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_penerbit\" id=\"nm_penerbit\"  placeholder=\"Nama Penerbit\" required>
                    </div>
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";       
    break;

    case"editpenerbit":
        $kode_penerbit = $_GET['kd_penerbit'];
        $hasil = mysqli_query($koneksidb, "SELECT * FROM penerbit WHERE kd_penerbit='$kode_penerbit'");       
        $r = mysqli_fetch_array($hasil);
        $dataKode = $r['kd_penerbit'];
     echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=penerbit\">Data Penerbit</a>
            </li>
        </ul>
    </div>";
    //form edit  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Tambah Penerbit</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=penerbit&act=update\">
                    <input type=\"hidden\" name=\"Kode\" value=\"$r[kd_penerbit]\">
                    <div class=\"form-group\">
                        <label>Kode Penerbit</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_penerbit\" placeholder=\"Kode Penerbit\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Penerbit</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_penerbit\" id=\"nm_penerbit\"  placeholder=\"Nama Penerbit\" value=\"$r[nm_penerbit]\" required>
                    </div>
                    
                    <button type=\"submit\" class=\"btn btn-default\">Simpan</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Batal</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";       
    break;
     }
}

