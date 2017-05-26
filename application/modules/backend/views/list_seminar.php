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
            <h1 class="page-header">Seminar</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default"> 
                <div class="panel-heading">
                    <div class="pull-left">
                        <a href="<?php echo site_url('backend/c_seminar/v_seminar') ?>" class="btn btn-primary">Add Seminar</a>
                    </div>
                    <div class="pull-right">
                        <?php echo form_open_multipart('backend/c_seminar/cari', array("id" => "form-search-seminar", "class" => "form-inline", "method" => "POST")); ?>  
                        <input type="text" name="search_seminar" class="form-control" id="search_seminar" placeholder="search By Tema Seminar" value="<?php
                        $session_searchSeminar = $this->session->userdata('pencarian_seminar');
                        echo (!empty($session_searchSeminar)) ? $session_searchSeminar : ''
                        ?>" />     
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="<?php echo site_url('backend/c_seminar') ?>" class="btn btn-primary btn-upgrade-mhs">show all</a>
                        <?php echo form_close(); ?>						
                    </div>
                </div>
                <?php if ($this->session->flashdata('infoSeminar')) { ?>
                    <div class="alert alert-success" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('infoSeminar'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('infoDeleteUser')) { ?>
                    <div class="alert alert-success" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('infoDeleteUser'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('infoErrorsPhoto')) { ?>
                    <div class="alert alert-warning" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed!</strong> <?php echo $this->session->flashdata('infoErrorsPhoto'); ?>
                    </div>
                <?php } ?>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tema Seminar</th>
                                <th>Jadwal Seminar</th>
                                <th>Pembicara Seminar</th>
                                <th>Tempat Seminar</th>
                                <th>Kuota Seminar</th>
                                <th>Sisa Kuota</th>
                                <th>Peserta Seminar</th>
                                <th>Status Seminar</th>								
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listSeminar as $key => $value): ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $value['tema'] ?></td>
                                    <td><?php echo $value['jadwal'] ?></td>	
                                    <td><?php echo $value['pembicara'] ?></td>	
                                    <td><?php echo $value['tempat'] ?></td>	
                                    <td><?php echo $value['kuota'] ?></td>	
                                    <td><?php echo $value['sisa_kuota'] ?></td>
                                    <td><?php if (!empty($value['list_peserta'])) { ?><a href="<?php echo site_url('backend/c_seminar/listPeserta/' . $value['seminar_id']) ?>" target="_blank">List Peserta</a><?php } ?></td>	
                                    <td><?php echo (($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Non Active</span>' ); ?></td>								
                                    <td class="text-center">
                                        <a style="cursor: pointer;" data-seminar-id="<?php echo $value['seminar_id']; ?>" class="manual_order"> Manual Order </a>  |
                                        <a href="<?php echo site_url('backend/c_seminar/v_seminar/' . $value['seminar_id']) ?>" >Edit</a>  
                                        | <a id="delete_seminar" id_delete_seminar="<?php echo $value['seminar_id'] ?>" >Delete</td>
                                </tr>
                            <?php endforeach; ?>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Seminar Order</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" id="order_email" name="order_email"  />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="order_seminar_id" id="order_seminar_id" />
                <button type="button" id="submit_manual_order" class="btn btn-primary btn-lg" style="width:100%">Daftar</button>
            </div>
        </div>

    </div>
</div>

</body>

</html>
<script>var base_url = "<?php echo base_url(); ?>"</script>
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
    $(document).on("click", "#delete_seminar", function () {
        var answer = confirm("Are you sure you want to Delete Seminar ID = " + $(this).attr('id_delete_seminar') + ' ?');
        if (answer) {
            $.ajax({
                type: "POST",
                url: base_url + 'backend/c_seminar/do_delete',
                data: {id: $(this).attr('id_delete_seminar')},
                dataType: "json",
                success: function (result) {
                    switch (result.returnVal) {
                        case "success":
                            alert(result.alert);
                            window.location.reload(base_url + 'seminar-admin');
                            break;
                        default:
                            alert(result.alert);
                            break;
                    }
                }
            });
        }
    })
    $(document).on("click", ".manual_order", function () {
        var seminar_id = $(this).data('seminar-id');
        $('#order_seminar_id').val(seminar_id);
        $('#myModal').modal('show');
    });
    
    $(document).on("click", "#submit_manual_order", function () {
        var seminar_id = $('#order_seminar_id').val();
        var email = $('#order_email').val();
        
        if (!email || !seminar_id) {
            alert('Email harus diisi !');
            return false;
        }
        
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('front/seminar/submit_order') ?>",
            data: {
                'email_member': email,
                'seminar_id': seminar_id,

            },
            dataType: 'json',
            success: function (results) {
                if (results.status == "success") {
                    alert("Terima kasih, Anda telah terdaftar di seminar");
                } else if (results.status == "error") {
                    alert(results.alert);
                } else {
                    alert(results.alert);
                }
                return false;
            }
        });
        
    });

</script>
