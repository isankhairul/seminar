
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">


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
		    <div class="panel-heading">Seminar</div>
			
			<div class="panel-body">
			<div class="col-md-8">
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
			<form action="<?php echo site_url('backend/c_seminar/submit_seminar')?>" method="post" id="form_seminar" type_form="<?php echo $type_form;?>" enctype="multipart/form-data">
			    <fieldset>
				<?php if (isset($getDetail->id_seminar)){ ?>
				<div class="form-group">
					<label>ID Seminar</label>
					<input class="form-control" placeholder="id" name="id" type="text" readonly="true" value="<?php echo (isset($getDetail->id_seminar) ? $getDetail->id_seminar : '')?>"></input>
				</div>
				<?php } ?>				
				<div class="form-group">
					<label>Tema Seminar</label>
					<input class="form-control" placeholder="Tema Seminar" id="tema_seminar" name="tema_seminar" type="text" autofocus="" value="<?php echo set_value('tema_seminar', $getDetail->tema_seminar)?> "></input>
				</div>
				<div class="form-group">
					<label>Jadwal Seminar</label>
					<input class="form-control" placeholder="Jadwal Seminar" id="jadwal_seminar" name="jadwal_seminar" type="text" autofocus="" value="<?php echo set_value('jadwal_seminar', $getDetail->jadwal_seminar)?> "></input>
				</div>
				<div class="form-group">
					<label>Pembicara Seminar</label>
					<input class="form-control" placeholder="Pembicara Seminar" id="pembicara_seminar" name="pembicara_seminar" type="text" autofocus="" value="<?php echo set_value('pembicara_seminar', $getDetail->pembicara_seminar)?> "></input>
				</div>
				<div class="form-group">
					<label>Tempat Seminar</label>
					<input class="form-control" placeholder="Tempat Seminar" id="tempat_seminar" name="tempat_seminar" type="text" autofocus="" value="<?php echo set_value('tempat_seminar', $getDetail->tempat_seminar)?> "></input>
				</div>
				<div class="form-group">
					<label>Kuota Seminar</label>
					<input class="form-control" placeholder="Kuota Seminar" id="kuota_seminar" name="kuota_seminar" type="text" autofocus="" value="<?php echo set_value('kuota_seminar', $getDetail->kuota_seminar)?> " <?php echo ($type_form == 'edit' ? disabled : '')?>></input>
				</div>
				<div class="form-group">
					<label>Kelas Seminar</label>
					<select class="form-control" id="kelas_seminar" name="kelas_seminar[]" multiple="multiple">
						<?php 
							$kelas_seminar = array('1' => "Reguler", '2' => 'Paralel');
							$det_kelas_seminar = explode(',', $getDetail->untuk_kelas);
							//echo '<pre>',print_r($det_kelas_seminar);
							$no = 0 ;
							foreach ($kelas_seminar as $key => $value) {
									$selected[$no] = (in_array($key, $det_kelas_seminar) ? 'selected' : '') ;
								
						?>
							<option value="<?php echo $key ?>" <?php echo $selected[$no];?>> <?php echo $value?> </option>
						<?php $no++;} ?>
					</select>
				</div>
				<div id="form_semester">
				<div class="form-group">
					<label>Semester Seminar</label>
					<select class="form-control seminar-multiple-select2" id="semester_seminar" name="semester_seminar[]" multiple="multiple" >
						<?php 
							$semester = array('1', '2', '3', '4', '5', '6', '7', '8', 'all');
							$det_semester_seminar = explode(',', $getDetail->semester_seminar);
							$no = 0 ;
							foreach ($semester as $key => $value) {
								$selected[$no] = (in_array($value, $det_semester_seminar) ? 'selected' : '') ;
						?>
						<option value="<?php echo $value ?>" <?php echo $selected[$no];?>>Seminar <?php echo $value?></option>
						<?php $no++;} ?>
					</select>
					<span style="font-size : 12px ; color : orange">Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</span>
				</div>
				</div>
				<!--<div class="form-group">
					<label>Jurusan Seminar</label>
					<select class="form-control jurusan-multiple-select2" id="nama_jurusan" name="nama_jurusan[]" multiple="multiple">
						<?php /*foreach ($listfakultas as $keyFak => $valueFak) { */?>
							<optgroup label="<?php /*echo $valueFak['nama_fakultas']*/?>">
								<?php /*foreach ($valueFak['listjurusan'] as $keyJur => $valueJur) { */ ?>
									<option value="<?php /* echo $valueJur['id_jurusan_fakultas'] */?>"><?php /*echo $valueJur['nama_jurusan'] */?></option>
								<?php /*}*/ ?>
						  	</optgroup>
						<?php /* } */	?>
					</select>					
				</div>-->
				<div class="form-group">
					<label>Poster Seminar</label>
					<input id="poster_seminar" name="poster_seminar" type="file" autofocus="" ></input>
					<?php if(!empty($getDetail->poster_seminar)){ ?>
						<img class="img-thumbnail" src="<?php echo $getDetail->poster_seminar?>">
					<?php } ?>
				</div>
				<!-- <div class="form-group">
					<label>Sertifikat Seminar</label>
					<input id="sertifikat_seminar" name="sertifikat_seminar" type="file" autofocus="" ></input>
				</div> -->
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
<script src="<?php echo base_url()?>assets/backend/js/select2.full.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/moment-with-locales.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/moment-locale-id.js"></script>
<script src="<?php echo base_url()?>assets/backend/js/bootstrap-datetimepicker.js"></script>
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
var main_url = '<?php echo base_url()?>' ;
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
    }));
	$("#kelas_seminar").select2();
	$(".seminar-multiple-select2").select2();	
	$(".jurusan-multiple-select2").select2();
	$( "#semester_seminar" ).change(function(){
	    var str = "";
	    $( "#semester_seminar option:selected" ).each(function() {
	    if($( this ).val() == 'all'){
	    	//$(this).select2('val', '');
	    	//$(this).select2('val', 'all');
	    	$("#semester_seminar").select2("val", "");
	    	
	    }
	    /*str += $( this ).val() + " ";*/
	    });
	    /*$( "#hasil_selected" ).text( str );*/
	})
	  .trigger( "change" );
	$('#jadwal_seminar').datetimepicker({
		format: 'YYYY-MM-DD HH:mm',
		locale : 'id'
	});

	/*$('#jadwal_seminar').datepicker({
            dateFormat: "yy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: "-100:+0"
    }); */
    /*$("#kelas_seminar").select2({
        dropdownAutoWidth: true,
        width: 'resolve',
        placeholder: 'Search',
        minimumInputLength: 1,
        allowClear: true,
        delay: 2000,
        ajax: {
            dataType: "json",
            url: main_url + 'backend/c_seminar/get_data_sparepart',
            data: function (term, page) {
                return {
                    term: term
                };
            },
            results: function (data) {
                var results = [];

                $.each(data, function(index, item){
                    results.push({
                        id: item.sparepart_code,
                        text: item.sparepart_code + ' - ' + item.sparepart_name,
                        rowid: rowid,
                        sparepart_name: item.sparepart_name,
                        sparepart_hargajual: item.sparepart_hargajual,
                        sparepart_id: item.sparepart_id,
                        sparepart_code: item.sparepart_code
                    });
                });
                return { results: results };
            },
            cache: true
        }
    });*/
})
</script>
