<link href="<?php echo base_url() ?>assets/backend/css/bootstrap-datetimepicker.css" rel="stylesheet">

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
                <div class="panel-heading">Seminar</div>

                <div class="panel-body">
                    <div class="col-md-8">
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
                        <form action="<?php echo site_url('backend/c_seminar/submit_seminar') ?>" method="post" id="form_seminar" type_form="<?php echo $type_form; ?>" enctype="multipart/form-data">
                            <fieldset>
                                <?php if (isset($getDetail->id_seminar)) { ?>
                                    <div class="form-group">
                                        <label>ID Seminar</label>
                                        <input class="form-control" placeholder="id" name="id" type="text" readonly="true" value="<?php echo (isset($getDetail->id_seminar) ? $getDetail->id_seminar : '') ?>"></input>
                                    </div>
                                <?php } ?>				
                                <div class="form-group">
                                    <label>Tema Seminar</label>
                                    <input class="form-control" placeholder="Tema Seminar" id="tema_seminar" name="tema_seminar" type="text" autofocus="" value="<?php echo set_value('tema_seminar', $getDetail->tema_seminar) ?> "></input>
                                </div>
                                <div class="form-group">
                                    <label>Description Seminar</label>
                                    <textarea class="form-control" placeholder="Description Seminar" id="desc_seminar" name="desc_seminar" rows="4" cols="50"><?php echo set_value('desc_seminar', $getDetail->desc_seminar) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jadwal Seminar</label>
                                    <div class='input-group date' id='jadwal_seminar' >
                                        <input type='text' name="jadwal_seminar"  class="form-control" placeholder="Jadwal Seminar" value="<?php echo set_value('jadwal_seminar', $getDetail->jadwal_seminar) ?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pembicara Seminar</label>
                                    <input class="form-control" placeholder="Pembicara Seminar" id="pembicara_seminar" name="pembicara_seminar" type="text" autofocus="" value="<?php echo set_value('pembicara_seminar', $getDetail->pembicara_seminar) ?> "></input>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Seminar</label>
                                    <input class="form-control" placeholder="Tempat Seminar" id="tempat_seminar" name="tempat_seminar" type="text" autofocus="" value="<?php echo set_value('tempat_seminar', $getDetail->tempat_seminar) ?> "></input>
                                </div>
                                <div class="form-group">
                                    <label>Kuota Seminar</label>
                                    <input class="form-control" placeholder="Kuota Seminar" id="kuota_seminar" name="kuota_seminar" type="text" autofocus="" value="<?php echo set_value('kuota_seminar', $getDetail->kuota_seminar) ?> " <?php echo ($type_form == 'edit' ? disabled : '') ?>></input>
                                </div>

                                <div class="form-group">
                                    <label>Poster Seminar</label>
                                    <input id="poster_seminar" name="poster_seminar" type="file" autofocus="" ></input>
                                    <?php if (!empty($getDetail->poster_seminar)) { ?>
                                        <img class="img-thumbnail" src="<?php echo $getDetail->poster_seminar ?>">
                                    <?php } ?>
                                </div>
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
<script src="<?php echo base_url() ?>assets/backend/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/chart-data.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/easypiechart.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/easypiechart-data.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/select2.full.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/moment-locale-id.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/bootstrap-datetimepicker.js"></script>
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
    var main_url = '<?php echo base_url() ?>';
    $(document).ready(function () {
        $('#form_jurusan_fakultas').on('submit', (function (e) {
            var type_form = $('#form_jurusan_fakultas').attr('type_form');
            if (type_form == 'edit') {
                if ($('#nama_jurusan_fak').val() == "") {
                    alert("Nama Jurusan Masih Kosong!");
                    $('#nama_jurusan_fak').focus();
                    return false;
                }
                return true;
            }
        }));
        $('#jadwal_seminar').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'id'
        });

    });
</script>
