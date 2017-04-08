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
		    <div class="panel-heading">Registrasi User</div>
			
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
			<form action="<?php echo site_url('backend/c_reg_user/register_user')?>" method="post" id="form_register_user" type_form="<?php echo $type_form;?>">
			    <fieldset>
				<?php if (isset($getDetail->id_user)){ ?>
				<div class="form-group">
					<label>Registrasi User</label>
					<input class="form-control" placeholder="id_user" name="id_user" type="text" readonly="true" value="<?php echo (isset($getDetail->id_user) ? $getDetail->id_user : '')?>"></input>
				</div>
				<?php } ?>				
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" placeholder="Nama Lengkap" id="nama" name="nama" type="text" autofocus=""value="<?php echo set_value('nama_user', $getDetail->nama_user)?> "></input>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" placeholder="Email" id="email" name="email" type="email" autofocus="" value="<?php echo (isset($getDetail->id_user) ? $getDetail->email_user : '')?>"></input>
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input class="form-control" placeholder="Telepon" id="telepon" name="telepon" type="text" autofocus="" value="<?php echo (isset($getDetail->id_user) ? $getDetail->telp_user : '')?>"></input>
				</div>
				<div class="form-group">
					<label>Category</label>
					<input class="form-control" placeholder="kategori user" id="kategori_user" name="kategori_user" type="text" autofocus="" value="<?php echo (isset($getDetail->id_user) ? $getDetail->kategori_user : '')?>"></input>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" placeholder="Username" id="username" name="username" type="text" autofocus="" value="<?php echo (isset($getDetail->id_user) ? $getDetail->username_user : '')?>"></input>
				</div>
				<?php if (!isset($getDetail->id_user)){ ?>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" placeholder="Password" name="password" type="password" autofocus="" value="<?php echo (isset($getDetail->id_user) ? $getDetail->password : '')?>"></input>
				</div>				
				<div class="form-group">
					<label>Retype Password</label>
					<input class="form-control" placeholder="Password" name="Re_password" type="password" autofocus=""></input>
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
    $('#form_register_user').on('submit',(function(e) {
        var type_form = $('#form_register_user').attr('type_form');
	if (type_form == 'edit') {
	    if($('#nama').val() == ""){
		alert("Nama Masih Kosong!");
		$('#nama').focus();
		return false;
	    }
	    if($('#email').val() == ""){
		alert("Email masih kosong !");
		$('#email').focus();
		return false;
	    }
	    if($('#kategori_user').val()== ""){
		alert("Kategori user masih kosong!");
		$('#kategori_user').focus();
		return false;
	    }
	    if($('#usernam').val()== ""){
		alert("Kategori user masih kosong!");
		$('#kategori_user').focus();
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
