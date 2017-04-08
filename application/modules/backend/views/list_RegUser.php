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
				<h1 class="page-header">Kategori User</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo site_url('backend/c_reg_user/v_registerUser')?>" class="btn btn-primary">Register User</a></div>
					<?php if($this->session->flashdata('infoRegisterUser')){ ?>
						<div class="alert alert-success" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> <?php echo $this->session->flashdata('infoRegisterUser'); ?>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('infoDeleteUser')){ ?>
						<div class="alert alert-success" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> <?php echo $this->session->flashdata('infoDeleteUser'); ?>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('infoCheckUsername')){ ?>
						<div class="alert alert-warning" style="margin: 15px">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Failed!</strong> <?php echo $this->session->flashdata('infoCheckUsername'); ?>
						</div>
					<?php } ?>
					<div class="panel-body">
						<table class="table table-bordered table-hover">
							<thead>
							  <tr>
								<th>No</th>
								<th>Nama Lengkap</th>								
								<th>User Name</th>
								<th>Email </th>
								<th>Telepon </th>
								<th>Kategori </th>
								<th>Create Date </th>
								<th>Update Date </th>
								<th>Action</th>
							  </tr>
							</thead>
							<tbody>
							<?php
							foreach($listRegisterUser as $key => $value){ ?>
							<tr>
								<td><?php echo ++$start ?></td>
								<td><?php echo $value['nama_user'] ?></td>
								<td><?php echo $value['username_user'] ?></td>
								<td><?php echo $value['email_user'] ?></td>
								<td><?php echo $value['telp_user'] ?></td>
								<td><?php echo $value['kategori_user'] ?></td>
								<td><?php echo $value['create_date'] ?></td>	
								<td><?php echo $value['update_date'] ?></td>
								
								<td class="text-center">
								    <a href="<?php echo site_url('backend/c_reg_user/v_registerUser/'.$value['id_user'])?>" >Edit</a>  
								    <?php if($value['id_user'] != 1){?>
								    | <a id="delete_user" id_user="<?php echo $value['id_user']?>" >Delete</td>
								    <?php } ?>
							</tr>  
							<?php }  ?>
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
$(document).on("click","#delete_user", function(){
    var answer = confirm("Are you sure you want to Cancel Register ID = "+$(this).attr('id_user')+' ?');
    if(answer){
             $.ajax({
                type: "POST",
                url: base_url+'backend/c_reg_user/do_delete',
                data: {id : $(this).attr('id_user')},
                dataType: "json",
                success: function(result){				
                    switch(result.returnVal){
                            case "success":
				alert(result.alert);
                                window.location.reload(base_url+'register_user');
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
