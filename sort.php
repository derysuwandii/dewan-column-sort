<?php
  include 'koneksi.php';

  $output = '';
  $order = $_POST["order"];
  if($order == 'desc'){
      $order = 'asc';
  } else {
    $order = 'desc';
  }

  $nama_kolom = $_POST["nama_kolom"];
  $orderby = $_POST["order"];

  $query = "SELECT * FROM tbl_karyawan ORDER BY ". $nama_kolom ." ". $orderby ."";
  $dewan1 = $db1->prepare($query);
  $dewan1->execute();
  $res1 = $dewan1->get_result();

  $output .= '
  <table class="table table-bordered">
      <tr>
           <th>No</th>
           <th><a class="column_sort" id="nama_lengkap" data-order="'.$order.'" href="#">Nama Lengkap</a></th>
           <th><a class="column_sort" id="alamat" data-order="'.$order.'" href="#">Alamat</a></th>
           <th><a class="column_sort" id="jenkel" data-order="'.$order.'" href="#">Jenis Kelamin</a></th>
           <th><a class="column_sort" id="jabatan" data-order="'.$order.'" href="#">Jabatan</a></th>
           <th><a class="column_sort" id="umur" data-order="'.$order.'" href="#">Umur</a></th>
      </tr>
  ';
  $no=1;
  while ($row = $res1->fetch_assoc()) {
      $output .= '
      <tr>
           <td>' . $no++ . '</td>
           <td>' . $row["nama_lengkap"] . '</td>
           <td>' . $row["alamat"] . '</td>
           <td>' . $row["jenkel"] . '</td>
           <td>' . $row["jabatan"] . '</td>
           <td>' . $row["umur"] . '</td>
      </tr>
      ';  
  }
  $output .= '</table>';
  echo $output;
?>