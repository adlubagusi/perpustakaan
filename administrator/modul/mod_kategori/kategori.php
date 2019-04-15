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
     $aksi = "modul/mod_kategori/aksi_kategori.php";   
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     $dataKode = buatKode("kategori", "K");
     switch($act){
         default:
               echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=kategori\">Data Kategori</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Kategori</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=kategori&act=tambahkategori\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Nama Kategori</th>
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM kategori";
   $tampil = mysqli_query($koneksidb,$query);
    $no = 1;
    while ($tyo = mysqli_fetch_array($tampil)):
         
         echo "<tr><td>$no</td>
             <td>$tyo[nm_kategori]</td>
             
            ";
        echo "           
                   <td>
            <a class=\"btn btn-info\" href=\"?module=kategori&act=editkategori&kd_kategori=$tyo[kd_kategori]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=kategori&act=hapus&kd_kategori=$tyo[kd_kategori]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI..?')\">
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


    case "tambahkategori":
            echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=kategori\">Data Kategori</a>
            </li>
        </ul>
    </div>";
    //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Kategori</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=kategori&act=input\">
                    <div class=\"form-group\">
                        <label>Kode Kategori</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_kategori\" placeholder=\"Kode Kategori\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Kategori</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_kategori\" id=\"nm_kategori\"  placeholder=\"Nama Kategori\" required>
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

    case"editkategori":
        $query="SELECT * FROM kategori WHERE kd_kategori='$_GET[kd_kategori]'";
        $hasil = mysqli_query( $koneksidb,$query);
        $r = mysqli_fetch_array($hasil);
        $dataKode = $r['kd_kategori'];
     echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=kategori\">Data Kategori</a>
            </li>
        </ul>
    </div>";
    //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Kategori</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=kategori&act=update\">
                    <input type=\"hidden\" name=\"Kode\" value=\"$r[kd_kategori]\">
                    <div class=\"form-group\">
                        <label>Kode Kategori</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_kategori\" placeholder=\"Kode Kategori\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Kategori</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_kategori\" id=\"nm_kategori\"  placeholder=\"Nama Kategori\" value=\"$r[nm_kategori]\" required>
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
     }
}

