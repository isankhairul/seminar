<!--Mulai input Body-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Peserta Seminar</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					<div class="pull-left">
						<a href="<?php echo site_url('backend/c_seminar/print_pesertaSeminar/'.$this->uri->segment(4))?>" class="btn btn-primary">Print Peserta Seminar</a>
					</div>
					<div class="pull-right">
						<?php echo form_open_multipart('backend/c_seminar/listPeserta/'.$this->uri->segment(4), array("id" => "form-search-peserta-seminar", "class" => "form-inline", "method" => "POST")); ?>  
						<input type="text" name="search_peserta" class="form-control" id="search_peserta" placeholder="search By Nama Peserta" value="<?php $session_searchPesertaSeminar = $this->session->userdata('pencarian_peserta_seminar'); echo (!empty($session_searchPesertaSeminar)) ? $session_searchPesertaSeminar : ''?>" />     
						<button type="submit" class="btn btn-primary">Cari</button>
						<a href="<?php echo site_url('backend/c_seminar/listPeserta/'.$this->uri->segment(4))?>" class="btn btn-primary btn-upgrade-mhs">show all</a>
						<?php echo form_close();?>						
					</div>
					</div>
					<?php if($this->session->flashdata('infoSeminar')){ ?>
						<div class="alert alert-success" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> <?php echo $this->session->flashdata('infoSeminar'); ?>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('infoDeleteUser')){ ?>
						<div class="alert alert-success" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> <?php echo $this->session->flashdata('infoDeleteUser'); ?>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('infoErrorsPhoto')){ ?>
						<div class="alert alert-warning" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Failed!</strong> <?php echo $this->session->flashdata('infoErrorsPhoto'); ?>
						</div>
					<?php } ?>
					<div class="panel-body">
						<table class="table table-bordered table-hover">
				        	<tr>
				        		<th>No</th>
				        		<th>Kehadiran</th>
				        		<th>Nama Peserta</th>
				        		<th>NIM Peserta</th>
				        		<th>Ticket Peserta</th>
				        		<th>Tema Seminar</th>
				        	</tr>
				        	<form action="<?php echo site_url('backend/c_fakultas/submit_fakultas')?>" method="post" id="form_fakultas">
				        	<?php foreach ($list_peserta as $keyList => $Listvalue): ?>
				        	<tr>			        	
				        		<td><?php echo ++$start?></td>
				        		<td><input type="checkbox" <?php echo($Listvalue['used_sertifikat'] == 1 ? 'checked' : '')?> name="order[]" id="peserta_<?php echo $Listvalue['id_order']?>" onclick="chkPeserta(<?php echo $Listvalue['id_order']?>)"></td>
				        		<td><?php echo $Listvalue['nama_depan'].' '.$Listvalue['nama_belakang']?></td>
				        		<td><?php echo $Listvalue['nim_mahasiswa']?></td>
				        		<td><?php echo $Listvalue['serial']?></td>
				        		<td><?php echo $Listvalue['tema_seminar']?></td>
				        	</tr>
				        	<?php endforeach;?>
				        </table>
				        </form>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<?php echo $pagination; ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
	</div><!--/.main-->

		
</body>

</html>
<script>var base_url = "<?php echo base_url();?>"</script>
<script src="<?php echo base_url()?>assets/backend/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/chart.min.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/chart-data.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/easypiechart.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/easypiechart-data.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/bootstrap-datepicker.js"></script>
<script>
	!function ($) {
		$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
			$(this).find('em:first').toggleClass("glyphicon-minus");	  
		}); 
		$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);

	$(window).on('resize', function () {
	  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
	  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})
</script>
<script>
$(document).on("click","#delete_jurusan_fakultas", function(){
    var answer = confirm("Are you sure you want to Delete Jurusan Fakultas ID = "+$(this).attr('id_jur_fakultas')+' ?');
    if(answer){
             $.ajax({
                type: "POST",
                url: base_url+'backend/c_jurusan_fak/do_delete',
                data: {id : $(this).attr('id_jur_fakultas')},
                dataType: "json",
                success: function(result){				
                    switch(result.returnVal){
                    case "success":
				alert(result.alert);
                    window.location.reload(base_url+'jurusan-fak');
                    break;
                    default:
                        alert(result.alert);
                    break;
                    }				
                }
            });
        }
    })

function chkPeserta(id_order){
    var chkPeserta;

    if(document.getElementById("peserta_"+id_order).checked == true){
        chkPeserta = 1;
    }else{
        chkPeserta = 0;
    }

    $.ajax({

        type: "POST",
        data: {"id":id_order, "chk":chkPeserta},
        url: base_url+"backend/c_seminar/change_kehadiran_peserta_seminar",
        dataType: "json",

        success: function(res){
        	switch(res.status){
        		case 'success' :
        			alert('Hadir') ;
        		break;

        		default:
        			alert('Tidak Hadir');
        		break;
        	}    
        }

    });

}
</script>
