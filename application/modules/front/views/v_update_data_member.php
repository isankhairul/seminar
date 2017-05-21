<style>
    .has-error > p {
        color: red !important;
    }
</style>
<div>
    <div class="container" style="background: white; box-shadow: 0 5px 5px 0 grey;">
        <h3 style="font-family: 'Alegreya', serif; margin-top: 40px">Biodata Mahasiswa</h3>
        <div style="margin-top: 10px; height: 10px; border: 0; box-shadow: 0 10px 10px -10px #0066FF inset; border-radius: 5px;"></div>
        <div style="margin-top:25px">
            <div class="col-md-3" style="font-size : 14px ;font-family : tahoma">
                <?php include('side_menu.php'); ?>
            </div>
            <div class="col-md-9" style="font-size : 14px ;font-family : tahoma">

                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Edit Member</h4></div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('infoCheckPassword')) { ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Maaf!</strong> <?php echo $this->session->flashdata('infoCheckPassword'); ?>
                            </div>

                            <?php
                            $this->session->unset_userdata('infoCheckPassword');
                        }
                        ?>
<?php if ($this->session->flashdata('infoChangePassword')) { ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Yeeayyy ! </strong> <?php echo $this->session->flashdata('infoChangePassword'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('infoChangePassword');
                        }
                        ?>

                            <?php if (validation_errors()) { ?>
                            <div class="has-error">
                            <?php echo validation_errors(); ?>
                            </div>
<?php } ?>
                        <!-- Form Register mahasiswa -->
                        <div role="tabpanel" class="tab-pane" id="register">
                            <div class="about-grids">
                                <div class="col-md-7 about-grid">

                                    <form action="<?php echo site_url('front/c_biomember/submit_update_member') ?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo (!empty($member['email'])) ? $member['email'] : $this->session->flashdata('email'); ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="Firstname">Firstname</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="<?php echo (!empty($member['firstname'])) ? $member['firstname'] : $this->session->flashdata('firstname'); ?>" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Nama Belakang</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" value="<?php echo (!empty($member['lastname'])) ? $member['lastname'] : $this->session->flashdata('lastname'); ?>" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo (!empty($member['phone'])) ? $member['phone'] : $this->session->flashdata('phone'); ?>"" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="input_file">Photo</label>
                                            <input type="file" id="photo" name="photo">
                                            <p class="help-block">Photo</p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>		
                                </div>
                                <div class="col-md-5 about-grid">
                                    <form action="<?php echo site_url('front/c_biomember/ChangePassword') ?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
                                        <div class="form-group">
                                            <label for="">Password Sekarang</label>
                                            <input type="password" class="form-control" id="current_pass" name="current_pass" placeholder="password sekarang" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password Baru</label>
                                            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="password baru" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ulangi Password Baru</label>
                                            <input type="password" class="form-control" id="re_new_pass" name="re_new_pass" placeholder="ulangi password baru" autocomplete="off">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Register mahasiswa -->
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
<!-- start-smoth-scrolling -->
<!-- search-scripts -->
<script src="<?php echo base_url() ?>assets/frontend/js/classie.js"></script>
<script src="<?php echo base_url() ?>assets/frontend/js/uisearch.js"></script>
<script>
    new UISearch(document.getElementById('sb-search'));
</script>
<!-- //search-scripts -->
<script src="<?php echo base_url() ?>assets/frontend/js/jquery.swipebox.min.js"></script> 
<script type="text/javascript">
    jQuery(function ($) {
        $(".swipebox").swipebox();
    });
</script>
<script src="<?php echo base_url() ?>assets/frontend/js/responsiveslides.min.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider3").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });
    });
</script>