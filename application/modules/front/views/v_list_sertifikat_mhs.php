<div style="overflow: auto; padding-bottom: 190px;">
	<div class="container" style="background: white; box-shadow: 0 5px 5px 0 grey;">
		<h3 style="font-family: 'Alegreya', serif; margin-top: 40px">Biodata Mahasiswa</h3>
		<div style="margin-top: 10px; height: 10px; border: 0; box-shadow: 0 10px 10px -10px #0066FF inset; border-radius: 5px;"></div>
		<div style="margin-top:25px">
			<div class="col-md-3" style="font-size : 14px ;font-family : tahoma">
				<div class="list-group">
					<a href="<?php echo site_url('mahasiswa-dashboard')?>" class="list-group-item active">Aksi Cepat</a>
					<a href="<?php echo site_url('mahasiswa-dashboard')?>" class="list-group-item">Detail Mahasiswa</a>
					<a href="<?php echo site_url('update-mahasiswa')?>" class="list-group-item">Edit Mahasiswa</a>
					<a href="<?php echo site_url('list-seminar')?>" class="list-group-item">List Seminar Mahasiswa</a>
					<a href="<?php echo site_url('list-sertifikat')?>" class="list-group-item">List Sertifikat Mahasiswa</a>
					<!-- <a href="#" class="list-group-item">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item">Vestibulum at eros</a> -->
				</div>
			</div>
			<div class="col-md-9" style="font-size : 14px ;font-family : tahoma">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>List Seminar</h4></div>
				  <div class="panel-body">
				  		<div class="pull-left"><a href="<?php echo site_url('front/c_biomhs/cetak_all_info_seminar/'.$listSeminar_mahasiswa[0]['id_mahasiswa'])?>"> <i class="glyphicon glyphicon-print" aria-hidden="true"></i> Cetak Laporan Sertifikat </a> </div>
				    	<table class="table table-bordered">
				    		
				    		<thead>
				    			<th>No</th>
				    			<th>Nama seminar</th>
				    			<th>Tanggal seminar</th>
				    			<th>Lokasi seminar</th>
				    			<th>Pembicara seminar</th>
				    			<th>Action seminar</th>
				    		</thead>
				    		<?php foreach ($listSeminar_mahasiswa as $key => $value) { ?>
				    			<tr>
					    			<td><?php echo ++$start?></td>
					    			<td><?php echo $value['tema_seminar']?></td>
					    			<td><?php echo $value['jadwal_seminar']?></td>
					    			<td><?php echo $value['tempat_seminar']?></td>
					    			<td><?php echo $value['pembicara_seminar']?></td>
					    			<td class="text-center"><?php if($value['used_sertifikat'] == 1){?> <a href="<?php echo site_url('front/c_biomhs/cetak_sertifikat/'.$value['id_order'])?>"> <i class="glyphicon glyphicon-print" aria-hidden="true"></i> Sertifikat </a><?php } ?></td>
					    		</tr>
				    		<?php } ?>

						</table>
				  </div>
				  <div class="row">
						<div class="col-md-12 text-center">
							<?php echo $pagination; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
	
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="footer-grids">
			<!-- <div class="col-md-3 footer-grid">
				<h3>PERSPICIATIS</h3>
				<ul>
					<li><a href="#">SUMMER CAMPS</a></li>
					<li><a href="#">CELEBRATIONS</a></li>
					<li><a href="#">ONLINE EXAMS</a></li>
					<li><a href="#">COMPETITIONS</a></li>
					<li><a href="#">ACTIVITIES</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-grid">
				<h3>PRAESENTIUM </h3>
				<ul>
					<li><a href="#">PRESENTATIONS</a></li>
					<li><a href="#">SEMINARS</a></li>
					<li><a href="#">PREPARATIONS</a></li>
					<li><a href="#">CONDUCTING GAMES</a></li>
					<li><a href="#">OTHER ACTIVITIES</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-grid">
				<h3>DIGNISSIMOS</h3>
				<ul>
					<li><a href="#">SUMMER CAMPS</a></li>
					<li><a href="#">CELEBRATIONS</a></li>
					<li><a href="#">ONLINE EXAMS</a></li>
					<li><a href="#">COMPETITIONS</a></li>
					<li><a href="#">ACTIVITIES</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-grid">
				<h3>PRAESENTIUM</h3>
				<ul>
					<li><a href="#">PRESENTATIONS</a></li>
					<li><a href="#">SEMINARS</a></li>
					<li><a href="#">PREPARATIONS</a></li>
					<li><a href="#">CONDUCTING GAMES</a></li>
					<li><a href="#">OTHER ACTIVITIES</a></li>
				</ul>
			</div> -->
			<!-- <div class="clearfix"></div> -->
		</div>
		<p> &copy; 2016 Event Organizer. All Rights Reserved | Design by Ariev Nurhidayat</p>
	</div>
</div>
<!-- smooth scrolling -->
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
</body>
</html>
<!-- js -->
<script src="<?php echo base_url()?>assets/frontend/js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- for bootstrap working -->
<script src="<?php echo base_url()?>assets/frontend/js/bootstrap.js"></script>
<!-- //for bootstrap working -->

<!-- smooth scrolling -->
<script type="text/javascript">
$(document).ready(function() {

	/*var defaults = {
	containerID: 'toTop', // fading element id
	containerHoverID: 'toTopHover', // fading element hover id
	scrollSpeed: 1200,
	easingType: 'linear' 
	};*/
								
	$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
<!-- //smooth scrolling -->
<script src="<?php echo base_url()?>assets/frontend/js/modernizr.custom.js"></script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- search-scripts -->
<script src="<?php echo base_url()?>assets/frontend/js/classie.js"></script>
<script src="<?php echo base_url()?>assets/frontend/js/uisearch.js"></script>
<script>
	new UISearch( document.getElementById( 'sb-search' ) );
</script>
<!-- //search-scripts -->
<script src="<?php echo base_url()?>assets/frontend/js/jquery.swipebox.min.js"></script> 
<script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
</script>
<script src="<?php echo base_url()?>assets/frontend/js/responsiveslides.min.js"></script>
<script>
	// You can also use "$(window).load(function() {"
	$(function () {
	 // Slideshow 4
	$("#slider3").responsiveSlides({
		auto: true,
		pager: true,
		nav: false,
		speed: 500,
		namespace: "callbacks",
		before: function () {
	$('.events').append("<li>before event fired.</li>");
	},
	after: function () {
		$('.events').append("<li>after event fired.</li>");
		}
		});
		});
</script>