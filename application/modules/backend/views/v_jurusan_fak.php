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
			<h1 class="page-header">Forms</h1>
		</div>
	</div><!--/.row-->
			    
	    
	<div class="row">
	    <div class="col-lg-12">
		<div class="panel panel-default">
		    <div class="panel-heading">Fakultas</div>
			
			<div class="panel-body">
			<div class="col-md-6">
			    <style>
				.has-error > p {
				    color: red !important;
				}
			    </style>
			    <div class="has-error">
				<?php
				echo validation_errors();
				?>
			    </div>
			<form action="<?php echo site_url('backend/c_jurusan_fak/submit_jurusan_fakultas')?>" method="post" id="form_jurusan_fakultas" type_form="<?php echo $type_form;?>">
			    <fieldset>
				<?php if (isset($getDetail->id_jurusan_fakultas)){ ?>
				<div class="form-group">
					<label>ID Jurusan Fakultas</label>
					<input class="form-control" placeholder="id" name="id" type="text" readonly="true" value="<?php echo (isset($getDetail->id_jurusan_fakultas) ? $getDetail->id_jurusan_fakultas : '')?>"></input>
				</div>
				<?php } ?>				
				<div class="form-group">
					<label>Nama Jurusan</label>
					<input class="form-control" placeholder="Nama Jurusan Fakultas" id="nama_jurusan_fak" name="nama_jurusan_fak" type="text" autofocus="" value="<?php echo set_value('nama_jurusan', $getDetail->nama_jurusan)?> "></input>
				</div>

				<div class="form-group">
					<label>Nama fakultas</label>
					<select class="form-control" id="nama_fakultas" name="nama_fakultas">
						<option value="">Pilih fakultas</option>
						<?php foreach ($listFakultas as $key => $value) { 
							$selectedFak = (($getDetail->id_fakultas == $value['id_fakultas']) ? 'selected' : '') ;	?>
							<option value="<?php echo $value['id_fakultas'];?>" <?php echo $selectedFak?>><?php echo $value['nama_fakultas'];?></option>
						<?php }	?>
					</select>
					
				</div>
				<?php if (isset($getDetail->id_jurusan_fakultas)){ ?>
				<div class="form-group">
					<label>Status Fakultas</label>
					<select class="form-control" id="status_jurusan_fakultas" name="status_jurusan_fakultas">
						<?php 
							$status_fak = array('1' => "Active", '2' => 'Non Active');
							foreach ($status_fak as $key => $value) {
								$selected = (($getDetail->status_jurusan == $key) ? 'selected' : '') ;
						?>
						<option value="<?php echo $key ?>" <?php echo $selected;?>><?php echo $value?></option>
						<?php } ?>
					</select>
				</div>
				<?php } ?>
				<button type="submit" class="btn btn-primary">Submit</button>
			    </fieldset>
			</form>

				</div>
			</div>
		</div>
	    </div><!-- /.col-->
	</div><!-- /.row -->
		
    </div>
    <!--/.main-->	
</body>

</html>
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
$(document).ready(function(){
    $('#form_jurusan_fakultas').on('submit',(function(e) {
        var type_form = $('#form_jurusan_fakultas').attr('type_form');
	if (type_form == 'edit') {
	    if($('#nama_jurusan_fak').val() == ""){
		alert("Nama Jurusan Masih Kosong!");
		$('#nama_jurusan_fak').focus();
		return false;
	    }
	    return true;
	}
	
	//if(Val_Change_Agent()==false){
        //    return false;
        //}else{
        //    e.preventDefault();
        //    //var formData = new FormData(this);
        //    var formData = $('#change-agent').serialize();
        //    $.ajax({
        //        type:'POST',
        //        url: $(this).attr('action'),
        //        dataType: 'json',
        //        data:formData,
        //        success:function(result){
        //            switch (result.returnVal) {
        //                case 'success' :
        //                    alert(result.alert);
        //                    window.location.reload();
        //                break;
        //                default:
        //                    alert(result.alert);
        //            }
        //        }
        //    });
        //}      
    }));
})
</script>
