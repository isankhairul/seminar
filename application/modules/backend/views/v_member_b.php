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
                            <input class="form-control" placeholder="id" name="id" type="hidden" readonly="true" value="<?php echo (isset($getDetail['member_id']) ? $getDetail['member_id'] : '') ?>"></input>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email" autocomplete="off" value="<?php echo (!empty($getDetail['email']) ? $getDetail['email'] : '') ?>" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" autocomplete="off" value="<?php echo (!empty($getDetail['firstname']) ? $getDetail['firstname'] : '') ?>">
                            </div>				  	
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" autocomplete="off"  value="<?php echo (!empty($getDetail['lastname']) ? $getDetail['lastname'] : '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <?php
                                    $status = array("L" => "Laki-Laki",
                                        "P" => "Perempuan");
                                    foreach ($status as $key => $item) {
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($getDetail['gender'] == $key) ? 'selected' : ''; ?>> 
                                            <?php echo $item; ?> 
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Date of birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" maxlength="13" placeholder="dob" autocomplete="off"  value="<?php echo (!empty($getDetail['dob']) ? $getDetail['dob'] : '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" maxlength="13" placeholder="No telp" autocomplete="off"  value="<?php echo (!empty($getDetail['phone']) ? $getDetail['phone'] : '') ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Status Seminar</label>
                                <select name="status" class="form-control">
                                    <?php
                                    $status = array(0 => "Non Active",
                                        1 => "Active");
                                    foreach ($status as $key => $item) {
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($getDetail['status'] == $key) ? 'selected' : ''; ?>> 
                                            <?php echo $item; ?> 
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input_file">Photo</label>
                                <input type="file" id="photo" name="photo">
                                <p class="help-block">Photo</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="col-md-6">
                        <form action="<?php echo site_url('backend/c_member/change_password_member') ?>" method="post" id="form_fakultas" type_form="<?php echo $type_form; ?>">
                            <?php if (isset($getDetail['member_id'])) { ?>
                                <input class="form-control" placeholder="id" name="id" type="hidden" readonly="true" value="<?php echo (isset($getDetail['member_id']) ? $getDetail['member_id'] : '') ?>"></input>
                            <?php } ?>	
                            <div class="form-group">
                                <label for="password">Change Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Retype Change Password</label>
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
