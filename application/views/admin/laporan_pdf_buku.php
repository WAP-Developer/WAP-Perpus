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
 <center><h3>Laporan Data Buku Perpustakaan Online</h3></center>
 <br/><br>
 <table class="table-data">
  <thead>
   <tr>
    <th>No</th>
	<th>Judul Buku</th>
	<th>Pengarang</th>
	<th>Tahun Terbit</th>
  <th>Penerbit</th>
	<th>ISBN</th>
	<th>Jumlah Buku</th>
	<th>Lokasi</th>
   </tr>
  </thead>
  <tbody>
   <?php
   $no = 1;
   foreach($buku as $b){
   ?>
   <tr>
     <td><?php echo $no++; ?></td>
	 <td><?php echo $b->judul_buku; ?></td>
	 <td><?php echo $b->pengarang; ?></td>
	 <td><?php echo $b->thn_terbit; ?></td>
	 <td><?php echo $b->penerbit; ?></td>
	 <td><?php echo $b->isbn; ?></td>
	 <td><?php echo $b->jumlah_buku; ?></td>
	 <td><?php echo $b->lokasi; ?></td>
   </tr>
   <?php
  }
  ?>
 </body>
</table>
</body>
</html>