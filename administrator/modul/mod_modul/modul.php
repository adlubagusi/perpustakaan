<?php
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
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
     $aksi = "modul/mod_modul/aksi_modul.php";
     
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     
     switch ($act){
         //show modul from database
         default :
                echo"     <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=modul\">Data Modul</a>
            </li>
        </ul>
    </div>";
   echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
       <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Modul</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=modul&act=tambahmodul\">Tambah Data</button></div>
       <table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
        <th>Urutan Modul</th>
        <th>Nama Modul</th>
        <th>Link</th>
        <th>Status</th>
        <th>Aktif</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>";
   $query = "SELECT * FROM modul ORDER BY urutan";
   $tampil = mysqli_query($koneksidb,$query);
   while($t = mysqli_fetch_array($tampil)){
      echo "<tr><td>$t[urutan]</td>
                <td>$t[nama_modul]</td>
                 <td>$t[link]</td>";
      
      if($t['status']=='admin'){
          echo "<td class=\"center\">
            <span class=\"label-success label label-default\">$t[status]</span>
        </td>";
      }
      else{
          echo "<td class=\"center\">
            <span class=\"label-default label label-danger\">$t[status]</span>
        </td>";
      }
               
      if($t['aktif']=='Y'){
          echo "<td class=\"center\">
            <span class=\"label-success label label-default\">$t[aktif]</span>
        </td>";
      }  
      else{
          echo "<td class=\"center\">
            <span class=\"label-default label label-danger\">$t[aktif]</span>
        </td>";
      }
     echo "                      
       <td>
            <a class=\"btn btn-info\" href=\"?module=modul&act=editmodul&id=$t[id_modul]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a></td>
          </tr>";
   }
   
   echo "</tbody></table>
       </div><!-- box content -->
       </div><!--box inner -->
       </div><!--box col-md-12 -->
       ";
   break;
   
   case"tambahmodul":
        echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Modul</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" method=\"POST\" action=\"$aksi?module=modul&act=input\">
                    <div class=\"form-group\">
                        <label>Nama Modul</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nama_modul\" placeholder=\"Nama Modul\" required>
                    </div>
                    <div class=\"form-group\">
                        <label>Link</label>
                        <input type=\"text\" class=\"form-control\" name=\"link\"  placeholder=\"Link\" required>
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

   case "editmodul":
    $query = "SELECT * FROM modul WHERE id_modul = '$_GET[id]'";
    $hasil = mysqli_query($query, $koneksidb);
    $r = mysqli_fetch_array($hasil);
       echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Edit Modul</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" method=\"POST\" action=\"$aksi?module=modul&act=update\">
                <input type=\"hidden\" value=\"$r[id_modul]\" name=\"id\">
                    <div class=\"form-group\">
                        <label>Urutan Menu</label>
                        <input type=\"text\" name=\"urutan\" class=\"form-control\" value=\"$r[urutan]\">
                    </div>
                    <div class=\"form-group\">
                        <label>Nama Modul</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nama_modul\" placeholder=\"Nama Modul\" value=\"$r[nama_modul]\">
                    </div>
                    <div class=\"form-group\">
                        <label>Link</label>
                        <input type=\"text\" class=\"form-control\" name=\"link\"  placeholder=\"Link\" value=\"$r[link]\" required>
                    </div>";
       if($r['status']=='admin'){
           echo "<div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"status\"  value=\"admin\" checked>
                        Admin
                    </label>
                </div>
                <div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"status\"  value=\"user\">
                        User
                    </label>
                </div>";
       }
       else{
           echo "<div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"status\"  value=\"admin\">
                        Admin
                    </label>
                </div>
                <div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"status\"  value=\"user\" checked>
                        User
                    </label>
                </div>";
      }
      
      if($r['aktif']=='Y'){
           echo "<div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"aktif\"  value=\"Y\" checked>
                        Y
                    </label>
                </div>
                <div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"aktif\"  value=\"N\">
                        N
                    </label>
                </div>";
       }
       else{
           echo "<div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"aktif\"  value=\"Y\">
                        Y
                    </label>
                </div>
                <div class=\"radio\">
                    <label>
                        <input type=\"radio\" name=\"aktif\"  value=\"N\" checked>
                        N
                    </label>
                </div>";
      }
       
       echo "             
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