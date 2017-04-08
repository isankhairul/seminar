<!DOCTYPE html>
<html>
<head>
	<title>Cetak sertifikat</title>
	<link href="<?php echo base_url()?>assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo base_url()?>assets/frontend/css/cetak_sertifikat.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div class="container">
	<div class="row">
		<div style="float : left; width: 140mm ;"><img src="<?php echo base_url()?>assets/frontend/images/logo_esa_unggul.jpg" height="75px"></div>
		<div style="float: right; width: 29mm ; margin-top: -75px"><img src="<?php echo base_url()?>assets/frontend/barcode/<?php echo $ticket_seminar->serial.'.gif'?>" ></div>
	</div>
	<div class="row" class="row" style="margin-top: 15mm">
		<div class="text-center" style="font-size: 36px; font-family: Times New Roman, Times, serif; letter-spacing: 15px; font-weight: bold;">SERTIFIKAT</div>
		<div class="text-center" style=" margin-top: -35px"><img src="<?php echo base_url()?>assets/frontend/images/Ornament/5.png"></div>
		<div class="text-center" style="margin-top:-25px; font-family: Times New Roman, Times, serif;"> Diberikan kepada :</div>
		<div class="text-center" style="margin-top:20px; letter-spacing:5px; font-family: Times New Roman, Times, serif;font-size:24px"> <?php echo $ticket_seminar->nama_depan.' '.$ticket_seminar->nama_belakang?></div>
		<div class="text-center" style="margin-top:-5px; letter-spacing:5px; font-family: Times New Roman, Times, serif;font-size:14px; font-weight: bold;"> <?php echo $ticket_seminar->nim_mahasiswa?></div>
		<div class="text-center" style="margin-top:25px; letter-spacing:5px;"> Peserta</div>
		<div class="text-center" style="margin-top:15px; font-size: 32px; letter-spacing:5px; font-family: New Century Schoolbook, serif;"> <?php echo $ticket_seminar->tema_seminar?></div>
		<div class="text-center" style="margin-top:15px; letter-spacing:5px;"> Diselenggarakan Oleh :</div>
		<div class="text-center" style="margin-top:15px; font-size:24px; letter-spacing:5px;"> Event Organizer Seminar</div>
		<div class="text-center" style="margin-top:10px; font-size:12px; letter-spacing:5px;"> <?php $date=date_create($ticket_seminar->jadwal_seminar); echo date_format($date,"d F Y");?></div>
	</div>
	<div class="row">
		<div class="text-center" style="float : left; width: 140mm ; margin-left: -20mm;margin-top: 35px ;font-size:18px;">Event Organizer</div>
		<div class="text-center" style="width: 140mm ; margin-top: -30px; margin-left: 170mm;font-size:18px;">Rektor Kampus Esa Unggul</div>
	</div>
	<div class="row" style="margin-top: 20mm">
		<div class="text-center" style="float : left; width: 140mm ; margin-left: -20mm;margin-top: 35px ;font-size:24px;">( ....................... )</div>
		<div class="text-center" style="width: 140mm ; margin-top: -30px; margin-left: 170mm;font-size:24px;">( .................... )</div>
	</div>
</div>

</body>
</html>
