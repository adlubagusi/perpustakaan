<?php 
error_reporting(0);
   $koneksi= mysqli_connect("localhost","root","","perpustakaan");
    
   if($_GET['module']==''){
        echo "<div class=\"thumbnail\">
                    <img class=\"img-responsive\" src=\"http://placehold.it/800x300\" alt=\"\">
                    <div class=\"caption-full\">
                        <h4 class=\"pull-right\">$24.99</h4>
                        <h4><a href=\"#\">Product Name</a>
                        </h4>
                        <p>See more snippets like these online store reviews at <a target=\"_blank\" href=\"http://bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                        <p>Want to make these reviews work? Check out
                            <strong><a href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this building a review system tutorial</a>
                            </strong>over at maxoffsky.com!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\">3 reviews</p>
                        <p>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            4.0 stars
                        </p>
                    </div>
                </div>";
   } 
    
    elseif($_GET['module']=='home'){
        echo "<div class=\"thumbnail\">
                    <img class=\"img-responsive\" src=\"http://placehold.it/800x300\" alt=\"\">
                    <div class=\"caption-full\">
                        <h4 class=\"pull-right\">$24.99</h4>
                        <h4><a href=\"#\">Product Name</a>
                        </h4>
                        <p>See more snippets like these online store reviews at <a target=\"_blank\" href=\"http://bootsnipp.com\">Bootsnipp - http://bootsnipp.com</a>.</p>
                        <p>Want to make these reviews work? Check out
                            <strong><a href=\"http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/\">this building a review system tutorial</a>
                            </strong>over at maxoffsky.com!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class=\"ratings\">
                        <p class=\"pull-right\">3 reviews</p>
                        <p>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star\"></span>
                            <span class=\"glyphicon glyphicon-star-empty\"></span>
                            4.0 stars
                        </p>
                    </div>
                </div>";
   } 
    elseif($_GET['module']=='databuku'){
        echo "<table id=\"example\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
                    <thead>
                        <tr>
    						<th>No</th>
    						<th>Judul</th>
    						<th>Tahun</th>
    						<th>Halaman</th>
    						<th>Pengarang</th>
    						<th>Jumlah</th>
    					</tr>
                    </thead>
                    <tbody>";
                            $sql = mysqli_query($koneksi,"SELECT * FROM buku");
                            
                            $nomor=1; 
                            while($data=mysqli_fetch_array($sql)){
                                echo "<tr>
                                    <td>$nomor</td>
                                    <td>$data[judul]</td>
                                    <td>$data[th_terbit]</td>
                                        <td>$data[halaman]</td>
                                        <td>$data[pengarang]</td>
                                         <td>$data[jumlah]</td>
                                    </tr>";
                            $nomor++;    
                            }
                echo"             
                    </tbody>
                    </table>";

                        
    }
?>