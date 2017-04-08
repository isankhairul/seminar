<!-- banner -->
<style>
	.has-error > p {
    	color: red !important;
	}
</style>
<div class="banner page-head">
</div>
<div class="about">
	<div class="container">
		<div class="help-info">
			<h2 class="tittle">ABOUT</h2>
		</div>
		<!-- Nav tabs -->
		<style type="text/css">
			.my-tab .tab-pane{ border:solid 1px #ddd; border-top: 0;}
		</style>
		<?php if($this->session->flashdata('infoErrorsPhoto')){ ?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoErrorsPhoto'); ?>
			</div>
		<?php } ?>
		<?php if($this->session->flashdata('infoNIMinvalid')){ ?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoNIMinvalid'); ?>
			</div>
		<?php } ?>
		<div>		  
		  	<ul class="nav nav-tabs" role="tablist">
		    	<li role="presentation" class="<?php echo ($tab_active == 'login' ? 'active' : '');?>" ><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
		    	<li role="presentation" class="<?php echo ($tab_active == 'register' ? 'active' : '');?>" ><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
		  	</ul>

		  	<!-- Tab panes -->
		  	
		  	<div class="tab-content my-tab">
			    <div role="tabpanel" class="tab-pane fade <?php echo ($tab_active == 'login' ? 'in active' : '');?>" id="login">
			    	<div class="about-grids">
				    	<div class="col-md-5 about-grid-left">
							<img src="<?php echo base_url()?>assets/frontend/images/sign-in.jpg" alt=""/>
						</div>
						<div class="col-md-7 about-grid">
						<form class="form-horizontal" action="<?php echo site_url('front/mahasiswa/mahasiswa_login')?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
								<div class="has-error">
									<?php
									echo validation_errors();
									?>
							    </div>
								<div class="form-group">
									<label for="input_NIM_login" class="col-sm-2 control-label">NIM</label>
								    <div class="col-sm-10">
								      	<input type="text" class="form-control" id="nim_login" name="nim_login" placeholder="NIM" autocomplete="off">
								    </div>
								</div>
							  	<div class="form-group">
							    	<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							    	<div class="col-sm-10">
							      		<input type="password" class="form-control" id="password_login" name="password_login" placeholder="Password" autocomplete="off">
							    	</div>
							  	</div><!-- 
							  	<div class="form-group">
							    	<label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
							    	<div class="col-sm-10">
							      		  	
							    	</div>
							  	</div> -->
							
							  	<div class="form-group">
							    	<div class="col-sm-offset-2 col-sm-10">
							      		<button type="submit" class="btn btn-default">Sign in</button>
							    	</div>
							  	</div>
							</form>					
						</div>
						<div class="clearfix"></div>
			    	</div>
			    </div>
			    <!-- Form Register mahasiswa -->
			    <div role="tabpanel" class="tab-pane fade <?php echo ($tab_active == 'register' ? 'in active' : '');?>" id="register">
			    	<div class="about-grids">
				    	<div class="col-md-5 about-grid-left">
							<img src="<?php echo base_url()?>assets/frontend/images/sign-up.jpg" alt=""/>
						</div>
						<div class="col-md-7 about-grid">

							<form action="<?php echo site_url('front/mahasiswa/submit_register_mhs')?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
							<div class="has-error">
									<?php
									echo validation_errors();
									?>
							    </div>
							  	<div class="form-group">
								    <label for="NamaDepan">Nama Depan</label>
								    <input type="text" class="form-control" id="namaDpn" name="namaDpn" placeholder="Nama Depan" autocomplete="off">
							  	</div>
							  	<div class="form-group">
								    <label for="NamaBelakang">Nama Belakang</label>
								    <input type="text" class="form-control" id="namaBlkg" name="namaBlkg" placeholder="Nama Belakang" autocomplete="off">
							  	</div>
							  	<div class="form-group">
								    <label for="NIMmahasiswa">NIM Mahasiswa</label>
								    <input type="text" class="form-control" id="NIMmhs" name="NIMmhs" placeholder="NIM" autocomplete="off">
								    <span style="color : red; font-size : 10px">* Harap Masukan NIM yang sesuai dengan KTM (Kartu tanda mahasiswa)</span>
							  	</div>
							  	<div class="form-group">
								    <label for="NIMmahasiswa">Tipe Mahasiswa</label>
								    <select class="form-control" id="tipe_mahasiswa" name="tipe_mahasiswa">
								    	<option value="">--PILIH--</option>
								    	<option value="1">REGULER</option>
								    	<option value="2">PARALEL</option>
								    </select>								   
							  	</div>
							  	<div class="form-group">
								    <label for="Emailmahasiswa">Email Mahasiswa</label>
								    <input type="email" class="form-control" id="emailmhs" name="emailmhs" placeholder="email" autocomplete="off" required pattern="[a-zA-Z0-9_.]+@[a-zA-Z0-9\-\_]+\.[a-z.]+">
							  	</div>
							  	<div class="form-group">
								    <label for="alamatmhs">Alamat Mahasiswa</label>
								    <textarea class="form-control" id="alamat_mhs" name="alamat_mhs"></textarea>
							  	</div>
							  	<div class="form-group">
								    <label for="telepon_mhs">Telepon Mahasiswa</label>
								    <input type="text" class="form-control" id="telp_mhs" name="telp_mhs" maxlength="13" placeholder="No telp" autocomplete="off">
							  	</div>
							  	<div class="form-group">
								    <label for="tahun_masuk">Tahun Masuk</label>
								    <select class="form-control" id="thn_masuk" name="thn_masuk">
								    	<option value="">--PILIH--</option>
								    	<?php 
								    		//year to start with
								    		$startdate = date('Y', strtotime('-5 years')) ;
								    		//year to end with - this is set to current year. You can change to specific year
											$enddate = date("Y");
											 
											$years = range ($startdate,$enddate);
											 
											//print years
											foreach($years as $year){
								    	?>
								    	<option value="<?php echo $year?>"><?php echo $year?></option>
								    	<?php } ?>
								    </select>
							  	</div>
							  	<div class="form-group">
								    <label for="statusSMT">Status semester</label>
								    <select class="form-control" id="status_smt" name="status_smt">
								    	<option value="">--PILIH--</option>
								    	<option value="genap">GENAP</option>
								    	<option value="ganjil">GANJIL</option>
								    </select>
							  	</div>
							  	<div class="form-group">
								    <label for="Fakultas">Fakultas mahasiswa</label>
								    <select class="form-control" id="fakultas" name="fakultas">
								    	<option value="">--PILIH FAKULTAS--</option>
								    	<?php foreach ($fakultas as $key => $value) { ?>
								    		<option value="<?php echo $value['id_fakultas']?>"><?php echo $value['nama_fakultas']?></option>
								    	<?php } ?>
								    </select>
							  	</div>
							  	<div class="form-group" id="kota_form" style="display:none"></div>
							  	<div class="form-group">
							    	<label for="passwordMHS">Password</label>
							    	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							  	</div>							  	
							  	<div class="form-group">
							    	<label for="RePasswordMHS">Password</label>
							    	<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password">
							  	</div>
							  	<div class="form-group">
							    	<label for="input_file">File input</label>
							    	<input type="file" id="photo_mhs" name="photo_mhs">
							    	<p class="help-block">Photo Mahasiswa</p>
							  	</div>
							  	<div class="form-group">
							  	</div>
							  	<button type="submit" class="btn btn-primary">Submit</button>
							</form>		
						</div>
						<div class="clearfix"></div>
			    	</div>
			    </div>
			    <!-- End Form Register mahasiswa -->
		  	</div>
		</div>
		<!-- Nav tabs -->
		<!-- <div class="about-grids">
			<div class="col-md-5 about-grid-left">
				<img src="<?php echo base_url()?>assets/frontend/images/g5.jpg" alt=""/>
			</div>
			<div class="col-md-7 about-grid">
				<h3>NEQUE PORRO QUISQUAM EST, QUI </h3>
				<p>Sed ut perspiciatis unde omnis iste natus error sit 
				voluptatem accusantium doloremque laudantium, totam rem aperiam, 
				eaque ipsa quae ab illo inventore veritatis et numquam eius modi 
				tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
				Ut enim ad minima veniam, quis nostrum</p>
				<p>numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
				Ut enim ad minima veniam, quis nostrum exercitation modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
				Ut enim ad minima veniam, quis</p>
			</div>
			<div class="clearfix"></div>
		</div> -->
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
			<div class="clearfix"></div>
		</div>
		<p> &copy; 2016 Event Organizer. All Rights Reserved | Design by Ariev Nurhidayat</a></p>
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
<script type="text/javascript">
$(document).ready(function() {
  	$("#fakultas").change(function(){
    		var selectValues = $("#fakultas").val();
    		var listJurusan  = '' ;
    		if (selectValues == 0 || selectValues == ""){
    			//var msg = "Kota / Kabupaten :<br><select name=\"kota_id\" disabled><option value=\"Pilih Kota / Kabupaten\">Pilih Propinsi Dahulu</option></select>";
  
    			$('#kota_form').hide('fade-out');
    			$('#kota_form').html('');
    		}else{
    			var fakultas_id = {id_fakultas:selectValues};
    			$('#kota_id').attr("disabled",true);
    			$.ajax({
                        type: "POST",
                        data: fakultas_id,
                        url: "<?php echo site_url('front/mahasiswa/get_jurusan')?>",
                        dataType: "json",
                        success: function(res){
                        	//list Jurusan
                        	listJurusan += '<label>Pilih Jurusan</label>'
				            listJurusan += '<select class="form-control" name="jurusan_fakultas" id="jurusan_fakultas">' ;
				            listJurusan += '<option value=""> -- Pilih Jurusan --</option>';
				            $.each(res.jurusan_fakultas, function( index, value ) {
				                //var selected = (value.name_area == res.data.testimonial["testimonial_lokasi"] ? 'selected' : '') ;
				                listJurusan += '<option value="'+value.id_jurusan_fakultas+'" >'+value.nama_jurusan+'</option>';
				            });
				            listJurusan += '</select>' 
				            $('#kota_form').show('fade-in');
				            $('#kota_form').html(listJurusan);
                			
                            
                            /*$('#jurusan_form').show('fade-in');
    						$('#jurusan_form').html(listJurusan);*/
                		
                        }
                
                    });
    		}
    });
});
</script>