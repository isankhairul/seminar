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
                <div class="list-group">
                    <a href="<?php echo site_url('mahasiswa-dashboard') ?>" class="list-group-item active">Aksi Cepat</a>
                    <a href="<?php echo site_url('mahasiswa-dashboard') ?>" class="list-group-item">Detail Mahasiswa</a>
                    <a href="<?php echo site_url('update-mahasiswa') ?>" class="list-group-item">Edit Mahasiswa</a>
                    <a href="<?php echo site_url('list-seminar') ?>" class="list-group-item">List Seminar Mahasiswa</a>
                    <a href="<?php echo site_url('list-sertifikat') ?>" class="list-group-item">List Sertifikat Mahasiswa</a>
                    <!-- <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item">Vestibulum at eros</a> -->
                </div>
            </div>
            <div class="col-md-9" style="font-size : 14px ;font-family : tahoma">

                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Edit Mahasiswa</h4></div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('infoCheckPassword')) { ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Maaf!</strong> <?php echo $this->session->flashdata('infoCheckPassword'); ?>
                            </div>

                            <?php $this->session->unset_userdata('infoCheckPassword');
                        } ?>
<?php if ($this->session->flashdata('infoChangePassword')) { ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Yeeayyy ! </strong> <?php echo $this->session->flashdata('infoChangePassword'); ?>
                            </div>
                                <?php $this->session->unset_userdata('infoChangePassword');
                            } ?>
                        <div class="has-error">
                            <?php
                            echo validation_errors();
                            ?>
                        </div>
                        <!-- Form Register mahasiswa -->
                        <div role="tabpanel" class="tab-pane" id="register">
                            <div class="about-grids">
                                <div class="col-md-7 about-grid">

                                    <form action="<?php echo site_url('front/c_biomhs/submit_update_mhs') ?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
                                        <div class="form-group">
                                            <label for="NamaDepan">Nama Depan</label>
                                            <input type="text" class="form-control" id="namaDpn" name="namaDpn" placeholder="Nama Depan" autocomplete="off" value="<?php echo $mahasiswa['nama_depan']; ?>" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaBelakang">Nama Belakang</label>
                                            <input type="text" class="form-control" id="namaBlkg" name="namaBlkg" placeholder="Nama Belakang" autocomplete="off" value="<?php echo $mahasiswa['nama_belakang']; ?>" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                            <label for="NIMmahasiswa">NIM Mahasiswa</label>
                                            <input type="text" class="form-control" id="NIMmhs" name="NIMmhs" placeholder="NIM" autocomplete="off" value="<?php echo $mahasiswa['nim_mahasiswa']; ?>" disabled="disabled">
                                            <span style="color : red; font-size : 10px">* Harap Masukan NIM yang sesuai dengan KTM (Kartu tanda mahasiswa)</span>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="NIMmahasiswa">Tipe Mahasiswa</label>
                                            <select class="form-control" id="tipe_mahasiswa" name="tipe_mahasiswa">
                                                <option value="">--PILIH--</option>
<?php if ($mahasiswa['tipe_mahasiswa'] == 1) { ?> 
                                                            <option value="1" selected="selected">REGULER</option>
                                                            <option value="2">PARALEL</option>
<?php } else { ?>
                                                            <option value="1">REGULER</option>
                                                            <option value="2" selected="selected">PARALEL</option>
<?php } ?>
                                                
                                            </select>								   
                                        </div> -->
                                        <div class="form-group">
                                            <label for="Emailmahasiswa">Email Mahasiswa</label>
                                            <input type="email" class="form-control" id="emailmhs" name="emailmhs" placeholder="email" autocomplete="off"  value="<?php echo $mahasiswa['email_mahasiswa']; ?>" required pattern="[a-zA-Z0-9_.]+@[a-zA-Z0-9\-\_]+\.[a-z.]+">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamatmhs">Alamat Mahasiswa</label>
                                            <textarea class="form-control" id="alamat_mhs" name="alamat_mhs"><?php echo $mahasiswa['alamat_mahasiswa']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon_mhs">Telepon Mahasiswa</label>
                                            <input type="text" class="form-control" id="telp_mhs" name="telp_mhs" maxlength="13" placeholder="No telp" autocomplete="off"  value="<?php echo $mahasiswa['telp_mahasiswa']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="input_file">Photo</label>
                                            <input type="file" id="photo_mhs" name="photo_mhs">
                                            <p class="help-block">Photo Mahasiswa</p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>		
                                </div>
                                <div class="col-md-5 about-grid">
                                    <form action="<?php echo site_url('front/c_biomhs/ChangePassword') ?>" method="post" id="form_register_mahasiswa" enctype="multipart/form-data" style="margin-bottom: 15px">
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
        <p> &copy; 2016 Event Organizer. All Rights Reserved | Design by Ariev Nurhidayat</a></p>
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