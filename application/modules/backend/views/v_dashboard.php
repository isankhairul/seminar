	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="<?php echo base_url()?>assets/backend/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/chart.min.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/chart-data.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/easypiechart.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url()?>assets/backend/js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

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
</body>

</html>
