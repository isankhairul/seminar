<!-- banner -->
<!-- <div class="banner"> -->
<!-- <div style="padding: 60px 0"> -->
	<div class="container-row">
		<!-- Responsive slider - START -->
    	<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
        <div class="slides" data-group="slides">
      		<ul>
  	    		<li>
	              	<div class="slide-body" data-group="slide">
	                	<img src="<?php echo base_url()?>assets/frontend/images/Esa-Unggul-Citra-Raya-1.jpg">
	              	</div>
  	    		</li>
  	    		<li>
	              	<div class="slide-body" data-group="slide">
	                	<img src="<?php echo base_url()?>assets/frontend/images/Esa-Unggul-Citra-Raya-1.jpg">
	              	</div>
  	    		</li>
  	    		<li>
	              	<div class="slide-body" data-group="slide">
	                	<img src="<?php echo base_url()?>assets/frontend/images/Esa-Unggul-Citra-Raya-1.jpg">
	              	</div>
  	    		</li>
  	    		<li>
	              	<div class="slide-body" data-group="slide">
	                	<img src="<?php echo base_url()?>assets/frontend/images/banner.jpg">
	              	</div>
  	    		</li>
  	    	</ul>
        </div>
        <a class="slider-control left" href="#"4da4a-jump="prev">Prev</a>
        <a class="slider-control right" href="#" data-jump="next">Next</a>
        <div class="pages">
          <a class="page" href="#" data-jump-to="1">1</a>
          <a class="page" href="#" data-jump-to="2">2</a>
          <a class="page" href="#" data-jump-to="3">3</a>
          <a class="page" href="#" data-jump-to="4">4</a>
        </div>
    	</div>
      <!-- Responsive slider - END -->
	</div>
<!-- </div> -->
<!-- <div class="banner-bottom" style="background : none">
	<div class="container">
		<h2 class="tittle">WELCOME TO TUTELAGE</h2> 
		<div class="bottom-grids">
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<h3>OUR INSTRUCTIONS</h3>
					<p>Sed ut perspiciatis unde
					omnis iste natus error sit 
					voluptatem accusantium doloremque
					explicabo.</p>
				</div>
				<div class="bottom-spa"><span class="glyphicon glyphicon-education" aria-hidden="true"></span></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<h3>OUR SUPPORT</h3>
					<p>Sed ut perspiciatis unde
					omnis iste natus error sit 
					voluptatem accusantium doloremque
					explicabo.</p>
				</div>
				<div class="bottom-spa"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<h3>OUR GUARANTEE</h3>
					<p>Sed ut perspiciatis unde
					omnis iste natus error sit 
					voluptatem accusantium doloremque
					explicabo.</p>
				</div>
				<div class="bottom-spa"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></div>
			</div>
			<div class="col-md-3 bottom-grid">
				<div class="bottom-text">
					<h3>OUR RELIABILITY</h3>
					<p>Sed ut perspiciatis unde
					omnis iste natus error sit 
					voluptatem accusantium doloremque
					explicabo.</p>
				</div>
				<div class="bottom-spa"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div> -->
<div style="padding: 60px 0">
	<div class="container div-shadow">
		<div class="col-md-7">
			<h2 class="tittle">DAFTAR SEMINAR</h2>
			<?php
				//echo "<pre>", print_r($seminar);
				foreach ($seminar as $key => $value):
			?>
				<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-body">
				    <table >
				    	<tr>
				    		<td>
				    			<a href="#" class="">
							      <img src="<?php echo $value['poster_seminar'] ?>" style="height:140px; width:100px" alt="...">
							    </a>
				    		</td>
				    		<td valign="top">
				    			<table class="table_margin">
				    				<tr>
							    		<td colspan="3" align="center"><b><?php echo $value['tema_seminar'] ?></b><br><br></td>
							    	</tr>
							    	<tr>
							    		<td width="160px">Pembicara Seminar</td>
							    		<td width="10px">:</td>
							    		<td><?php echo $value['pembicara_seminar'] ?></td>
							    	</tr>
							    	<tr>
						    		<td>Jadwal Seminar</td>
						    		<td>:</td>
						    		<td>
						    		<?php 

						    			$date = date_create($value['jadwal_seminar']);
										$day = date_format($date,"N");
										$array_hari = array(1=>Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu);
										$hari = $array_hari[$day];
										$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

										$tahun = substr($value['jadwal_seminar'], 0, 4);
										$bulan = substr($value['jadwal_seminar'], 5, 2);
										$tgl   = substr($value['jadwal_seminar'], 8, 2);

										$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
										$pukul 	= substr($value['jadwal_seminar'], 11, 5);
							    		echo $hari. ', '. $result .' - '. $pukul ?></td>
							    	</tr>
							    	<tr>
							    		<td>Tempat Seminar</td>
							    		<td>:</td>
							    		<td><?php echo $value['tempat_seminar'] ?></td>
							    	</tr>
							    	<tr>
							    		<td>Sisa Kuota</td>
							    		<td>:</td>
							    		<td><?php echo $value['sisa_kuota'] ?></td>
							    	</tr>
							    	<tr>
							    		<td>Kelas Seminar</td>
							    		<td>:</td>
							    		<td><?php 
										switch($value['untuk_kelas']){
											case '1' :
											$kelas_seminar = 'Reguler' ;
											break;
											
											case '2' :
											$kelas_seminar = 'Paralel' ;
											break;
											default :
											$kelas_seminar = 'Paralel dan Reguler' ;
										}
										echo $kelas_seminar ?></td>
							    	</tr>		    	
							    	<tr>
							    		<td>Semester Seminar</td>
							    		<td>:</td>
							    		<td><?php echo $value['semester_seminar'] ?></td>
							    	</tr>
				    			</table>
				    		</td>
				    	</tr>
				    </table>
				    <button type="button" class="btn btn-primary btn-lg" style="display:block; float:right" data-toggle="modal" data-target="#myModal-<?php echo $value['id_seminar'] ?>">Daftar</button>
				  </div>
				</div>
			</div>

			<!-- Modal -->
			<div id="myModal-<?php echo $value['id_seminar'] ?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Seminar</h4>
			      </div>
			      <div class="modal-body">
			        <div class="panel panel-default">
					  <div class="panel-body">
					  <?php $session_mhs = $this->session->userdata('CMS_mahasiswa'); 
					  //echo "<pre>",print_r($session_mhs);
					  ?>
					    <table class="table">
					    	<tr>
				    			<td width="160px">Tema Seminar</td>
					    		<td width="10px">:</td>
					    		<td><?php echo $value['tema_seminar'] ?></td>
					    	</tr>
					    	<tr>
					    		<td>Pembicara Seminar</td>
					    		<td>:</td>
					    		<td><?php echo $value['pembicara_seminar'] ?></td>
					    	</tr>
					    	<tr>
					    		<td>Jadwal Seminar</td>
					    		<td>:</td>
					    		<td><?php echo $value['jadwal_seminar'] ?></td>
					    	</tr>
					    	<tr>
					    		<td>Tempat Seminar</td>
					    		<td>:</td>
					    		<td><?php echo $value['tempat_seminar'] ?></td>
					    	</tr>
					    	<tr>
					    		<td>Kuota Seminar</td>
					    		<td>:</td>
					    		<td><?php echo $value['kuota_seminar'] ?></td>
					    	</tr>
							<tr>
					    		<td>Kelas Seminar</td>
					    		<td>:</td>
					    		<td><?php 
								switch($value['untuk_kelas']){
									case '1' :
									$kelas_seminar = 'Reguler' ;
									break;
									
									case '2' :
									$kelas_seminar = 'Paralel' ;
									break;
									default :
									$kelas_seminar = 'Paralel dan Reguler' ;
								}
								echo $kelas_seminar ?></td>
					    	</tr>
					    	<tr>
					    		<td>Semester Seminar</td>
					    		<td>:</td>
					    		<td><?php echo $value['semester_seminar'] ?></td>
					    	</tr>
					    	<tr>
					    		<td>NIM Mahasiswa</td>
					    		<td>:</td>
					    		<td><?php echo $session_mhs['nim_mahasiswa']?></td>
					    	</tr>
					    	<tr>
					    		<td>Nama Mahasiswa</td>
					    		<td>:</td>
					    		<td><?php echo $session_mhs['nama_depan'].' '.$session_mhs['nama_belakang']?></td>
					    	</tr>	    	
					    	<tr>
					    		<td colspan="3" style="color:red">*Pastikan data mahasiswa sudah benar, jika belum silahkan ubah data mahasiswa</td>
					    	</tr>
					    </table>
					  </div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary btn-lg" style="width:100%" onclick="daftar_seminar(<?php echo $value['id_seminar'] ?>)">Daftar</button>
			      </div>
			    </div>

			  </div>
			</div>

			<?php		
				endforeach;
			?>
		</div>
		<div class="col-md-5">
			<!-- News -->
			<div class="col-md-12">
				<h2 class="tittle">News</h2>	
				<div class="row" style="border : 1px solid grey ; background: #ffffff ; padding : 5px; margin-bottom: 10px">			
					<!-- baris 1 -->
			  		<table class="table">
				    	<tr>
				    		<td>
				    			<a href="<?php echo base_url(); ?>news/6-Mahasiswa-Terpilih-di-Asean-University-Games" class="">
							      <img src="http://www.esaunggul.ac.id/wp-content/themes/topbusiness1/timthumb.php?src=http://www.esaunggul.ac.id/wp-content/uploads/2016/08/Tim-Basket-Universitas-Esa-Unggul-Mewakili-Indonesia-di-Ajang-Asean-University-Games.jpg&h=50&w=50&zc=1&q=90&a=t" style="height:50px; width:50px" alt="...">
							    </a>
				    		</td>
				    		
				    		<td><a href="<?php echo base_url(); ?>news/6-Mahasiswa-Terpilih-di-Asean-University-Games">Selamat dan Sukses 6 Mahasiswa Universitas Esa Unggul Terpilih Mewakili Indonesia di Ajang Asean University Games, Singapore 2016 </a></td>
				    	</tr>
				    	<tr>
				    		<td>
				    			<a href="<?php echo base_url(); ?>news/workshop-teknik-konversi" class="">
							      <img src="http://www.esaunggul.ac.id/wp-content/themes/topbusiness1/timthumb.php?src=http://www.esaunggul.ac.id/wp-content/uploads/2016/08/Workshop-Teknik-Konversi-Modul-Perkuliahan-Menjadi-Buku-Ajar.jpg&h=50&w=50&zc=1&q=90&a=t" style="height:50px; width:50px" alt="...">
							    </a>
				    		</td>
				    		<td><a href="<?php echo base_url(); ?>news/workshop-teknik-konversi">Workshop Teknik Konversi Modul Perkuliahan Menjadi Buku Ajar Tahun 2016</a></td>
				    	</tr>
				    	<tr>
				    		<td>
				    			<a href="<?php echo base_url(); ?>news/keberhasilan-team-pkm-bidang-kewirausahaan" class="">
							      <img src="http://www.esaunggul.ac.id/wp-content/themes/topbusiness1/timthumb.php?src=http://www.esaunggul.ac.id/wp-content/uploads/2016/08/PIMNAS-2016.jpg&h=50&w=50&zc=1&q=90&a=t" style="height:50px; width:50px" alt="...">
							    </a>
				    		</td>
				    		<td><a href="<?php echo base_url(); ?>news/keberhasilan-team-pkm-bidang-kewirausahaan">Selamat Atas Keberhasilan 1 Team PKM Bidang Kewirausahaan Tahun 2015 Anggaran Pendanaan 2016 Lolos Ke Pekan Ilmiah Mahasiswa Nasional (PIMNAS) Ke-29 di Institut Pertanian Bogor</a></td>
				    	</tr>
				    	<tr>
				    		<td>
				    			<a href="<?php echo base_url(); ?>news/pembukaan-pre-university-education" class="">
							      <img src="http://www.esaunggul.ac.id/wp-content/themes/topbusiness1/timthumb.php?src=http://www.esaunggul.ac.id/wp-content/uploads/2016/08/Pre-University-Education-2016.jpg&h=50&w=50&zc=1&q=90&a=t" style="height:50px; width:50px" alt="...">
							    </a>
				    		</td>
				    		<td><a href="<?php echo base_url(); ?>news/pembukaan-pre-university-education">Pembukaan Pre University Education, Awali Kuliah Dengan Seminar Pengembangan Diri Untuk Berprestasi</a></td>
				    	</tr>
				    	<tr>
				    		<td>
				    			<a href="<?php echo base_url(); ?>news/9-mahasiswa-universitas-esa-unggul-lulus-double-degree-nanjing-xiaozhuang" class="">
							      <img src="http://www.esaunggul.ac.id/wp-content/themes/topbusiness1/timthumb.php?src=http://www.esaunggul.ac.id/wp-content/uploads/2016/08/Wisuda-Mahasiswa-Universitas-Esa-Unggul-Program-Beasiswa-Unggulan-Double-Degree.jpg&h=50&w=50&zc=1&q=90&a=t" style="height:50px" alt="...">
							    </a>
				    		</td>
				    		<td><a href="<?php echo base_url(); ?>news/9-mahasiswa-universitas-esa-unggul-lulus-double-degree-nanjing-xiaozhuang">Selamat dan Sukses Kepada 9 Mahasiswa Universitas Esa Unggul Lulus Double Degree Nanjing Xiaozhuang University Batch 2, China</a></td>
				    	</tr>
				    </table>
				
				</div>
			</div>
			<!-- END News -->
		</div>
		
	</div>
</div>

<!-- <div class="teachers">
	<div class="container">
		<div class="teach-head">
			<h3>OUR TEACHERS</h3>
			<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis 
			praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.</p>
		</div>
		<div class="team-grids">
			<div class="col-md-3 team-grid text-center">
				<div class="team-img">
					<img src="<?php echo base_url()?>assets/frontend/images/1.png" alt=""/>
					<h3>FEDERICA</h3>
					<h4>Co-founder</h4>
					<p>Nam libero tempore, cum soluta nobis
					est eligendi optio cumque nihil impedit
					quo minus</p>
					<ul>
						<li><a class="fb" href="#"></a></li>
						<li><a class="twitt" href="#"></a></li>
						<li><a class="goog" href="#"></a></li>
						<li><a class="drib" href="#"></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 team-grid text-center">
				<div class="team-img">
					<img src="<?php echo base_url()?>assets/frontend/images/2.png" alt=""/>
					<h3>PATRICK</h3>
					<h4>Co-founder</h4>
					<p>Nam libero tempore, cum soluta nobis
					est eligendi optio cumque nihil impedit
					quo minus</p>
					<ul>
						<li><a class="fb" href="#"></a></li>
						<li><a class="twitt" href="#"></a></li>
						<li><a class="goog" href="#"></a></li>
						<li><a class="drib" href="#"></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 team-grid text-center">
				<div class="team-img">
					<img src="<?php echo base_url()?>assets/frontend/images/3.png" alt=""/>
					<h3>THOMPSON</h3>
					<h4>Co-founder</h4>
					<p>Nam libero tempore, cum soluta nobis
					est eligendi optio cumque nihil impedit
					quo minus</p>
					<ul>
						<li><a class="fb" href="#"></a></li>
						<li><a class="twitt" href="#"></a></li>
						<li><a class="goog" href="#"></a></li>
						<li><a class="drib" href="#"></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 team-grid text-center">
				<div class="team-img">
					<img src="<?php echo base_url()?>assets/frontend/images/4.png" alt=""/>
					<h3>VICTORIA</h3>
					<h4>Co-founder</h4>
					<p>Nam libero tempore, cum soluta nobis
					est eligendi optio cumque nihil impedit
					quo minus</p>
					<ul>
						<li><a class="fb" href="#"></a></li>
						<li><a class="twitt" href="#"></a></li>
						<li><a class="goog" href="#"></a></li>
						<li><a class="drib" href="#"></a></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div> -->
<!-- <div class="facilities">
	<div class="container">
		<h3 class="tittle">FACILITIES</h3> 	
				<div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g1.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g1.jpg" alt="" >
                    <div class="mask">
                        <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
                <div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g2.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g2.jpg" alt="" >
                    <div class="mask">
                         <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
                <div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g3.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g3.jpg" alt="">
                    <div class="mask">
                         <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
                <div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g4.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g4.jpg" alt="">
                    <div class="mask">
                        <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
				<div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g5.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g5.jpg" alt="">
                    <div class="mask">
                        <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
				<div class="view view-seventh">
                    <a href="<?php echo base_url()?>assets/frontend/images/g6.jpg" class="b-link-stripe b-animate-go  swipebox"  title="Image Title"><img src="<?php echo base_url()?>assets/frontend/images/g6.jpg" alt="">
                    <div class="mask">
                        <h4>TUTELAGE</h4>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        
                    </div></a>
                </div>
				<div class="clearfix"></div>
	</div>
</div>  -->
<!-- //our facilities -->
<!-- features -->
<!-- <div class="features">
	<div class="container">
		<h3 class="tittle">FEATURES</h3> 
		<div class="col-md-5 features-left">
			<img src="<?php echo base_url()?>assets/frontend/images/f1.jpg" alt=""/>
		</div>
		<div class="col-md-7 features-right">
			<h4>SPECIAL CARE ON STUDENTS</h4>
				<p> Neque porro quisquam est, qui dolorem ipsum 
				quia dolor sit amet, consectetur, adipisci velit, 
				sed quia non numquam eius modi tempora incidunt ut 
				labore et dolore magnam aliquam quaerat voluptatem. 
				Ut enim ad minima veniam, quis nostrum exercitationem 
				ullam corporis suscipit laboriosam, nisi ut aliquid 
				ex ea commodi consequatu.</p>
				<p>Temporibus autem quibusdam et aut officiis debitis aut rerum 
				necessitatibus saepe eveniet ut et voluptates repudiandae sint et 
				molestiae non recusandae. Itaque earum rerum veniam, quis nostrum exercitationem 
				ullam corporis suscipit laboriosam, nisi ut aliquid 
				ex ea commodi consequatu.</p>

		</div>
		<div class="clearfix"></div>
	</div>
</div> -->
<!-- //features -->
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
		</div> -->
		<p> &copy; 2016 Event Organizer. All Rights Reserved | Design by Ariev Nurhidayat</a></p>
	</div>
</div> 
<!-- //footer -->

<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

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
<script src="<?php echo base_url()?>assets/frontend/js/jquery.event.move.js"></script>
<script src="<?php echo base_url()?>assets/frontend/js/responsive-slider.js"></script>
<script>
	function daftar_seminar(id_seminar){

		var id_mhs 		= "<?php echo $session_mhs['id_mahasiswa']?>";

		if(!id_mhs){
			alert('Maaf, Anda harus login sebelum mendaftar!');
			location.href = "<?php echo base_url('login?ref='); ?>";
		}else{
			//alert($(this).attr('sem_id'));return false;
			$.ajax({
		        type: 'POST',
		        url: "<?php echo base_url('front/seminar/submit_order') ?>",
		        data: {
		         'id_mhs': id_mhs,
		         'id_seminar': id_seminar

		        },
		        dataType: 'json',
		        success: function(results){
		        	console.log(results);
	             	if(results.status == "success"){
		              	alert("Terima kasih, Anda telah terdaftar di seminar");
		              	location.href = results.location;
		              	return true;

	             	}else if(results.status == "error"){
	             		alert(results.alert);
	             		window.location.reload();
	             	}
	             	else{
	             		alert(results.alert);
		              	window.location.reload();
	             	}

	             	return false;
		        }
	  		});
		}		

	}

</script>
