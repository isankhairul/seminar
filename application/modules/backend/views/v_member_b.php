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
                <div class="panel-heading">
                    <div class="col-md-6">
                        Member
                    </div>
                    <div class="col-md-6">
                        Password Member
                    </div>		    
                </div>

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
                        <form action="<?php echo site_url('backend/c_member/edit_member') ?>" method="POST" id="form_edit_member" type_form="<?php echo $type_form; ?>" enctype="multipart/form-data">
                            <input class="form-control" placeholder="id" name="id" type="hidden" readonly="true" value="<?php echo (isset($getDetail['id_member']) ? $getDetail['id_member'] : '') ?>"></input>
                            <div class="form-group">
                                <label for="NIMmember">NIM Member</label>
                                <input type="text" class="form-control" id="NIMmhs" name="NIMmhs" placeholder="NIM" autocomplete="off" value="<?php echo (!empty($getDetail['nim_member']) ? $getDetail['nim_member'] : '') ?>" disabled="disabled">
                                <span style="color : red; font-size : 10px">* Harap Masukan NIM yang sesuai dengan KTM (Kartu tanda member)</span>
                            </div>
                            <div class="form-group">
                                <label for="NamaDepan">Nama</label>
                                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" placeholder="Nama" autocomplete="off" value="<?php echo (!empty($getDetail['nama_depan']) ? $getDetail['nama_depan'] : '') ?>">
                            </div>				  	
                            <div class="form-group">
                                <label for="Emailmember">Email Member</label>
                                <input type="email" class="form-control" id="emailmhs" name="emailmhs" placeholder="email" autocomplete="off"  value="<?php echo (!empty($getDetail['email_member']) ? $getDetail['email_member'] : '') ?>" required pattern="[a-zA-Z0-9_.]+@[a-zA-Z0-9\-\_]+\.[a-z.]+">
                            </div>
                            <div class="form-group">
                                <label for="alamatmhs">Alamat Member</label>
                                <textarea class="form-control" id="alamat_mhs" name="alamat_mhs"><?php echo (!empty($getDetail['alamat_member']) ? $getDetail['alamat_member'] : '') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="telepon_mhs">Telepon Member</label>
                                <input type="text" class="form-control" id="telp_mhs" name="telp_mhs" maxlength="13" placeholder="No telp" autocomplete="off"  value="<?php echo (!empty($getDetail['telp_member']) ? $getDetail['telp_member'] : '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="input_file">Photo</label>
                                <input type="file" id="photo_mhs" name="photo_mhs">
                                <p class="help-block">Photo Member</p>
                                <img class="img-thumbnail" src="<?php echo (!empty($getDetail['photo_member']) ? $getDetail['photo_member'] : '') ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="col-md-6">
                        <form action="<?php echo site_url('backend/c_member/change_password_mhs') ?>" method="post" id="form_fakultas" type_form="<?php echo $type_form; ?>">
                            <?php if (isset($getDetail['id_member'])) { ?>
                                <input class="form-control" placeholder="id" name="id" type="hidden" readonly="true" value="<?php echo (isset($getDetail['id_member']) ? $getDetail['id_member'] : '') ?>"></input>
                            <?php } ?>	
                            <div class="form-group">
                                <label for="NIMmember">Change Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="NamaDepan">Retype Change Password</label>
                                <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="Retype Password" autocomplete="off">
                            </div>	
                            <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="<?php echo base_url() ?>assets/backend/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/chart-data.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/easypiechart.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/easypiechart-data.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/bootstrap-datepicker.js"></script>
<script>
    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768)
            $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767)
            $('#sidebar-collapse').collapse('hide')
    })
</script>
<script>
    $(document).ready(function () {
        $('#form_edit_member').on('submit', (function (e) {
            var type_form = $('#form_edit_member').attr('type_form');
            if (type_form == 'edit') {
                if ($('#nama_mhs').val() == "") {
                    alert("Nama Masih Kosong!");
                    $('#nama_mhs').focus();
                    return false;
                }
                if ($('#emailmhs').val() == "") {
                    alert("Email Masih Kosong!");
                    $('#emailmhs').focus();
                    return false;
                }
                return true;
            }

        }));
    })
</script>
