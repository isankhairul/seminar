<!-- banner -->
<style>
    .has-error > p {
        color: red !important;
    }
</style>
<div class="about">
    <div class="container">
        <div class="help-info">
            <h2 class="tittle">Resend Confirmation</h2>
            
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Resend Confirmation</h4></div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('info')) { ?>
                            <div class="alert alert-warning">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong></strong> <?php echo $this->session->flashdata('info'); ?>
                            </div>
                        <?php } ?>
                        
                        
                        
                        <div class="col-md-5 about-grid">
                            <form action="<?php echo site_url('resend-confirmation') ?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo set_value('email'); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
            <div class="clearfix"></div>
        </div>
        <p> &copy; 2016 Event Organizer. All Rights Reserved</p>
    </div>
</div>
<!-- smooth scrolling -->
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
</body>
</html>
<!-- js -->
<script src="<?php echo base_url() ?>assets/frontend/js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- for bootstrap working -->
<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.js"></script>
<!-- //for bootstrap working -->

<!-- smooth scrolling -->
<!-- //smooth scrolling -->
<script src="<?php echo base_url() ?>assets/frontend/js/modernizr.custom.js"></script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
</script>