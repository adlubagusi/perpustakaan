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
    $aksi = "modul/mod_siswa/aksi_siswa.php";   
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     
     switch($act){
         default:
               echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=siswa\">Data Siswa</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">Data Siswa</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-warning\" onclick=window.location.href=\"?module=siswa&act=tambahsiswa\">Import Data</button>  <button class=\"btn btn-success\" onclick=window.location.href=\"?module=siswa&act=tambah\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>
         <th>NISN</th>
        <th>Nama Siswa</th>
        <th>Kelamin</th>
        <th>Kelas</th>
        <th>Tempat Lahir</th>
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM siswa ORDER BY nm_siswa ASC";
   $tampil = mysqli_query($koneksidb,$query);
    $no = 1;
    while ($tyo = mysqli_fetch_array($tampil)):
         
         echo "<tr><td>$no</td>
             <td>$tyo[nisn]</td>
             <td>$tyo[nm_siswa]</td>
             <td>$tyo[kelamin]</td>
             <td>$tyo[kelas]</td>
             <td>$tyo[tempat_lahir]</td>";
        echo "           
            <td>
            <a class=\"btn btn-info\" href=\"?module=siswa&act=editsiswa&nisn=$tyo[nisn]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=siswa&act=hapus&nisn=$tyo[nisn]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
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

   case "tambahsiswa":
    echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=siswa\">Data Siswa</a>
            </li>
        </ul>
    </div>";
    //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Siswa</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=siswa&act=input\" enctype=\"multipart/form-data\">
                    
                    
                    <div class=\"form-group\">
                        <label>Upload XLS</label>
                        <input type=\"file\"  name=\"userfile\" >
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
   
   case "tambah":
        echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=siswa\">Data Siswa</a>
            </li>
        </ul>
    </div>";
       
   //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Siswa</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=siswa&act=inputsiswa\" >
                    
                    
                    <div class=\"form-group\">
                        <label>NISN</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nisn\" required oninvalid=\"this.setCustomValidity('NISN tidak boleh kosong')\" oninput=\"setCustomValidity('')\">
                    </div>
                     <div class=\"form-group\">
                        <label>Nama Siswa</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nm_siswa\" required oninvalid=\"this.setCustomValidity('Nama tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
                    </div>
                     <div class=\"form-group\">
                        <label>Jenis Kelamin</label><br>
                        <input type=\"radio\"  name=\"kelamin\" value=\"L\" checked>Laki-Laki  <input type=\"radio\"  name=\"kelamin\" value=\"P\">Perempuan
                    </div>
                     <div class=\"form-group\">
                        <label>Kelas</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kelas\" required oninvalid=\"this.setCustomValidity('Kelas tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
                    </div>
                    <div class=\"form-group\">
                        <label>Tempat Lahir</label>
                        <input type=\"text\" class=\"form-control\"  name=\"tempat_lahir\" required oninvalid=\"this.setCustomValidity('Tempat Lahir tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
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



    //edit siswa 
    case "editsiswa":
        $query = "SELECT * FROM siswa WHERE nisn = '$_GET[nisn]'";
        $hasil = mysqli_query($koneksidb, $query);
        $r = mysqli_fetch_array($hasil);
        echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=siswa\">Data Siswa</a>
            </li>
        </ul>
    </div>";
       
   //form tambah  
  echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Siswa</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=siswa&act=update\" >
                    <input type=\"hidden\" name=\"nisn\" value=\"$r[nisn]\">
                    
                    <div class=\"form-group\">
                        <label>NISN</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nisn\" value=\"$r[nisn]\" required oninvalid=\"this.setCustomValidity('NISN tidak boleh kosong')\" oninput=\"setCustomValidity('')\" readonly>
                    </div>
                     <div class=\"form-group\">
                        <label>Nama Siswa</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nm_siswa\" value=\"$r[nm_siswa]\" required oninvalid=\"this.setCustomValidity('Nama tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
                    </div>
                     <div class=\"form-group\">
                        <label>Jenis Kelamin</label><br>
                        <input type=\"radio\"  name=\"kelamin\" value=\"L\" checked>Laki-Laki  <input type=\"radio\"  name=\"kelamin\" value=\"P\">Perempuan
                    </div>
                     <div class=\"form-group\">
                        <label>Kelas</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kelas\" value=\"$r[kelas]\" required oninvalid=\"this.setCustomValidity('Kelas tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
                    </div>
                    <div class=\"form-group\">
                        <label>Tempat Lahir</label>
                        <input type=\"text\" class=\"form-control\"  name=\"tempat_lahir\" value=\"$r[tempat_lahir]\" required oninvalid=\"this.setCustomValidity('Tempat Lahir tidak boleh kosong')\" oninput=\"setCustomValidity('')\" >
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
