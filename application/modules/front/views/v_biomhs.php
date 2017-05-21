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
                    <div class="panel-heading"><h4>Detail Member</h4></div>
                    <div class="panel-body">
                        <table class="table table-bordered" style="font-weight : bold ; font-size: 16px ; color : #fff">
                            <?php $session_member = $this->session->userdata('CMS_member');?>
                            
                            <tr>
                                <td>Photo</td>
                                <td>

                                    <img class="img-thumbnail" style="max-width: 150px" src="<?php echo $session_member['photo'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $session_member['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td><?php echo $session_member['firstname'] . ' ' . $session_member['lastname'] ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><?php echo $session_member['phone'] ?></td>
                            </tr>
                        </table>
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
<script type="text/javascript">
    $(document).ready(function () {
        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>
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