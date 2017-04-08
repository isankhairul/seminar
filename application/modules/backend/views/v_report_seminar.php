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
				<h1 class="page-header">Report Seminar</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default"> 
					<?php if($this->session->flashdata('info_Report')){ ?>
						<div class="alert alert-success" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Warning!</strong> <?php echo $this->session->flashdata('info_Report'); ?>
						</div>
					<?php } ?>
					<div class="panel-heading">
					<div class="pull-left">
						<?php echo form_open_multipart('backend/c_report/show_report', array("id" => "form-periode-report", "class" => "form-inline", "method" => "POST")); ?>  
						<input type="text" name="periode_report" class="form-control" id="periode_report" value="<?php $session_searchReport = $this->session->userdata('pencarian_report'); echo (!empty($session_searchReport)) ? $session_searchReport : ''?>" />     
						<button type="submit" name="show_report" class="btn btn-primary" value="show_report">Show Report</button>
						<button type="submit" name="print_report" class="btn btn-primary" value="print_report">Print Report</button>
						<?php echo form_close();?>						
					</div>
					</div>
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
							<thead>
							  <tr>
								<th>No</th>
								<th>Tema Seminar</th>
								<th>Jadwal Seminar</th>
								<th>Jumlah Peserta Hadir</th>
							  </tr>
							</thead>
							<tbody>
							<?php
							$no = 1 ;
							foreach($report_seminar as $key => $value): ?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $value['tema_seminar'] ?></td>
								<td><?php echo $value['jadwal_seminar'] ?></td>	
								<td><?php echo $value['total'] ?></td>
							</tr>
							<?php $no++; endforeach;  ?>
							</tbody>
						</table>
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
<script src="<?php echo base_url()?>assets/backend/js/daterangepicker/daterangepicker.js"></script>
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
$('#periode_report').daterangepicker({
        format: 'YYYY-MM-DD',
        timePicker: true,
        timePickerSeconds: false,
        
        showDropdowns: true,
        showWeekNumbers: true,
        timePickerIncrement: 1,
        timePicker12Hour: false
    });
$(document).on("click","#delete_seminar", function(){	
    var answer = confirm("Are you sure you want to Delete Seminar ID = "+$(this).attr('id_delete_seminar')+' ?');
    if(answer){
             $.ajax({
                type: "POST",
                url: base_url+'backend/c_seminar/do_delete',
                data: {id : $(this).attr('id_delete_seminar')},
                dataType: "json",
                success: function(result){				
                    switch(result.returnVal){
                    case "success":
				alert(result.alert);
                    window.location.reload(base_url+'seminar-admin');
                    break;
                    default:
                        alert(result.alert);
                    break;
                    }				
                }
            });
        }
    })
</script>
