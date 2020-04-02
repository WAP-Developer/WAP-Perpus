<!DOCTYPE html>
<html>
<head>
 <title></title>
</head>
<body>
 <style type="text/css">
 .table-data{
 width: 100%;
 border-collapse: collapse;
 }
 
 .table-data tr th,
 .table-data tr td{
  border:1px solid black;
  font-size: 10pt;
  }
 </style>
 <center><h3>Laporan Data Anggota Perpustakaan Online</h3></center>
 <br/><br>
 <table class="table-data">
  <thead>
   <tr>
        <th>No</th>
        <th>Nama Anggota</th>
        <th>Gender</th>
        <th>No.Telpon</th>
        <th>Alamat</th>
        <th>Email</th>
   </tr>
  </thead>
  <tbody>
   <?php
   $no = 1;
   foreach($anggota as $a){
   ?>
   <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $a->nama_anggota ?></td>
        <td><?php echo $a->gender ?></td>
        <td><?php echo $a->no_telp ?></td>
        <td><?php echo $a->alamat ?></td>
        <td><?php echo $a->email ?></td>
   </tr>
   <?php
  }
  ?>
 </body>
</table>
</body>
</html>