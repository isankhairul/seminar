<!-- banner -->
<style>
    .has-error > p {
        color: red !important;
    }
</style>
<div class="about">
    <div class="container">
        <div class="help-info">
            <h2 class="tittle">LOGIN</h2>
        </div>
        <!-- Nav tabs -->
        <style type="text/css">
            .my-tab .tab-pane{ border:solid 1px #ddd; border-top: 0;}
        </style>
        <?php if ($this->session->flashdata('infoErrorsPhoto')) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoErrorsPhoto'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('infoInsertFailed')) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoInsertFailed'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('infoFailedLogin')) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoFailedLogin'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('infoEmailinvalid')) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>OOooppsss!</strong> <?php echo $this->session->flashdata('infoEmailinvalid'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('infoSuccessRegister')) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="success" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('infoSuccessRegister'); ?>
            </div>
        <?php } ?>
        <div>		  
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php echo ($tab_active == 'login' ? 'active' : ''); ?>" ><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
                <li role="presentation" class="<?php echo ($tab_active == 'register' ? 'active' : ''); ?>" ><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
            </ul>

            <!-- Tab panes -->

            <div class="tab-content my-tab">
                <div role="tabpanel" class="tab-pane fade <?php echo ($tab_active == 'login' ? 'in active' : ''); ?>" id="login">
                    <div class="about-grids">
                        <div class="col-md-5 about-grid-left">
                            <img src="<?php echo base_url() ?>assets/frontend/images/sign-in.jpg" alt=""/>
                        </div>
                        <div class="col-md-7 about-grid">
                            <form class="form-horizontal" action="<?php echo site_url('front/member/member_login') ?>" method="post" id="form_register_member" enctype="multipart/form-data" style="margin-bottom: 15px">
                                <div class="has-error">
                                    <?php
                                    echo validation_errors();
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (!empty(set_value('email'))) ? set_value('email') : $this->session->flashdata('email'); ?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required="required">
                                    </div>
                                </div>

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
                <!-- Form Register member -->
                <div role="tabpanel" class="tab-pane fade <?php echo ($tab_active == 'register' ? 'in active' : ''); ?>" id="register">
                    <div class="about-grids">
                        <div class="col-md-5 about-grid-left">
                            <img src="<?php echo base_url() ?>assets/frontend/images/sign-up.jpg" alt=""/>
                        </div>
                        <div class="col-md-7 about-grid">

                            <form action="<?php echo site_url('front/member/submit_register_member') ?>" method="post" id="form_register_member" enctype="multipart/form-data" style="margin-bottom: 15px">
                                <div class="has-error">
                                    <?php
                                    echo validation_errors();
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo (!empty(set_value('email'))) ? set_value('email') : $this->session->flashdata('email'); ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="repassword">Retype Password</label>
                                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="Firstname">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="<?php echo (!empty(set_value('firstname'))) ? set_value('firstname') : $this->session->flashdata('firstname'); ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" value="<?php echo (!empty(set_value('lastname'))) ? set_value('lastname') : $this->session->flashdata('lastname'); ?>" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo (!empty(set_value('phone'))) ? set_value('phone') : $this->session->flashdata('phone'); ?>"" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="photo">File input</label>
                                    <input type="file" id="photo" name="photo">
                                    <p class="help-block">Photo</p>
                                </div>
                                <div class="form-group">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>		
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- End Form Register member -->
            </div>
        </div>
        <!-- Nav tabs -->
        <!-- <div class="about-grids">
                <div class="col-md-5 about-grid-left">
                        <img src="<?php echo base_url() ?>assets/frontend/images/g5.jpg" alt=""/>
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