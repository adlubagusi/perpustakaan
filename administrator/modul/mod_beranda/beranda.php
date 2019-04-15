<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Beranda</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $siswa = mysqli_fetch_array(mysqli_query($koneksidb,"SELECT count(*) as total FROM siswa")); ?>
        <a data-toggle="tooltip" title="Jumlah Pasien <?php echo $siswa['total']; ?>" class="well top-block" href="?module=siswa">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Siswa</div>
            <div><?php echo $siswa['total']; ?></div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $penerbit = mysqli_fetch_array(mysqli_query($koneksidb,"SELECT count(*) as total FROM penerbit")); ?>
        <a data-toggle="tooltip" title="<?php echo $penerbit['total']; ?>" class="well top-block" href="?module=penerbit">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Penerbit</div>
            <div><?php echo $penerbit['total']; ?></div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $buku = mysqli_fetch_array(mysqli_query($koneksidb,"SELECT count(*) as total FROM buku")); ?>
        <a data-toggle="tooltip" title="<?php echo $buku['total']; ?>" class="well top-block" href="#">
            <i class="glyphicon glyphicon-book yellow"></i>

            <div>Buku</div>
            <div><?php echo $buku['total']; ?></div>
           
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $grafik = mysqli_fetch_array(mysqli_query($koneksidb,"SELECT count(*) as total FROM peminjaman")); ?>
        <a data-toggle="tooltip" title="Grafik" class="well top-block" href="?module=grafik">
            <i class="glyphicon glyphicon-signal red" title="<?php echo $grafik['total']; ?>" class="well top-block"></i>

            <div>Grafik</div>
            <div></div>
         
        </a>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Introduction</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>SIMPUS( Sistem Informasi Manajemen Perpustakaan)
                        <small>Selamat Datang di SIMPUS</small>
                    </h1>
                    <p>Anda Saat Ini Login sebagai <?php echo $_SESSION['namauser']; ?> </p>

                    

                   
                </div>
                
            </div>
        </div>
    </div>
</div>
