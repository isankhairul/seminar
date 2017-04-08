<!DOCTYPE html>
<html>
<head>
	<title>ALl Seminar</title>
	<!-- <link href="<?php echo base_url()?>assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> -->
	<link href="<?php echo base_url()?>assets/frontend/css/style_all_seminar.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div align="center">
<table class="tab_header" width="720">
<thead>
	<tr>
		<td align="center" width="70">
			<img src="<?php echo base_url()?>assets/frontend/images/esaunggul.png" width="65">
		</td>
		<td valign="middle">
			<!--div class="div_preheader">KEMENTERIAN PENDIDIKAN NASIONAL DAN KEBUDAYAAN</div-->
			<div class="div_header">UNIVERSITAS ESA UNGGUL</div>
			<div class="div_headertext">Jalan Arjuna Utara No.9, Kebon Jeruk - Jakarta Barat 11510 <br>
			021 - 5674223 (hunting) 021- 5682510 (direct) Fax : 021 - 5674248<br> 
			Website: www.esaunggul.ac.id, email: info@esaunggul.ac.id</div>
		</td>
	</tr>
	</thead>
</table>

<div class="div_head" style="text-align:center">KARTU SERTIFIKAT MAHASISWA</div>

<table class="tb_head" width="720">
	<tbody>
	<tr valign="top">
		<td width="60"><strong>N I M</strong></td>
		<td align="center" width="10">:</td>
		<td class="mark" width="310"><?php echo $all_seminar[0]['nim_mahasiswa']?></td>
		<td width="60"><strong>Prodi</strong>
		</td><td align="center" width="10">:</td>
		<td><?php echo $all_seminar[0]['nama_jurusan']?></td>
	</tr>
	<tr valign="top">
		<td><strong>Nama</strong></td>
		<td align="center">:</td>
		<td class="mark"><strong><?php echo strtoupper($all_seminar[0]['nama_depan'])?></strong></td>
		<td><strong>Fakultas</strong></td>
		<td align="center">:</td>
		<td><?php echo $all_seminar[0]['nama_fakultas']?></td>
	</tr>
	</tbody>
</table>
<div style="height:5px"></div>

<table class="table_data">
  <thead>
	<tr>
		<th>No</th>
		<th>Tema Seminar</th>
		<th>Jadwal Seminar</th>
		<th>Serial Sertifikat</th>
	</tr>
</thead>
  	<?php 
		$no = 1 ;
		foreach ($all_seminar as $key => $value) { ?>
		<tr>
			<td><?php echo $no?></td>
			<td><?php echo $value['tema_seminar']?></td>
			<td><?php 
				$date = date_create($value['jadwal_seminar']);
				$date = date_format($date,"Y-m-d");
				echo $date?>
				
			</td>
			<td><?php echo $value['serial']?></td>
		</tr>
	<?php $no++;} ?>
</table>
<div style="height:30px"></div>
<div style="text-align:right; margin-right:30px">
	<p> Event Organizer</p> 
	<p style="margin-top:80px"> (......................)</p> 
</div>
</div>
</body>
</html>
