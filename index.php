<?php include 'koneksi.php'; ?>  

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>Sort Kolom Tabel - www.dewankomputer.com</title>
    <link rel="stylesheet" href="css/bootstrap-3.3.6.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.1.0.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php" style="color: #fff;">
      Dewan Komputer
    </a>
  </nav>

   <div class="container" align="center">
      <h3 class="text-center">Sort Kolom Tabel dengan Ajax JQuery pada PHP</h3><br />
      <div class="table-responsive" id="tabel_karyawam">
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th><a class="column_sort" id="nama_lengkap" data-order="desc" href="#">Nama Lengkap</a></th>
            <th><a class="column_sort" id="alamat" data-order="desc" href="#">Alamat</a></th>
            <th><a class="column_sort" id="jenkel" data-order="desc" href="#">Jenis Kelamin</a></th>
            <th><a class="column_sort" id="jabatan" data-order="desc" href="#">Jabatan</a></th>
            <th><a class="column_sort" id="umur" data-order="desc" href="#">Umur</a></th>
          </tr>
          <?php
            $no=1;
            $query = "SELECT * FROM tbl_karyawan ORDER BY nama_lengkap ASC";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();
            while ($row = $res1->fetch_assoc()) {
          ?>  
          <tr>  
              <td><?php echo $no++; ?></td>
              <td><?php echo $row["nama_lengkap"]; ?></td>
              <td><?php echo $row["alamat"]; ?></td>
              <td><?php echo $row["jenkel"]; ?></td>
              <td><?php echo $row["jabatan"]; ?></td>
              <td><?php echo $row["umur"]; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
   </div>
</body>
</html>
<script>
   $(document).ready(function(){
      $(document).on('click', '.column_sort', function(){
         var nama_kolom = $(this).attr("id");
         var order = $(this).data("order");
         var arrow = '';
         if(order == 'desc'){
              arrow = '&nbsp;<span class="fa fa-arrow-down"></span>';
         } else {
              arrow = '&nbsp;<span class="fa fa-arrow-up"></span>';
         }
         $.ajax({
            url:"sort.php",
            method:"POST",
            data:{nama_kolom:nama_kolom, order:order},
            success:function(data)
            {
                 $('#tabel_karyawam').html(data);
                 $('#'+nama_kolom+'').append(arrow);
            }
         })
      });
   });
</script>