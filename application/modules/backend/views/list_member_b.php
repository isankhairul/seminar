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
            <h1 class="page-header">Member</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <?php echo form_open_multipart('backend/c_member/cari', array("id" => "form-search-member", "class" => "form-inline", "method" => "POST")); ?>  
                        <input type="text" name="search_member" class="form-control" id="search_member" placeholder="search By EMAIL / NAMA" value="<?php $session_searchMahasiswa = $this->session->userdata('pencarian_member');
                        echo (!empty($session_searchMahasiswa)) ? $session_searchMahasiswa : '' ?>" />     
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="<?php echo site_url('backend/c_member') ?>" class="btn btn-primary btn-upgrade-mhs">show all</a>
<?php echo form_close(); ?>						
                    </div>					
                </div>
<?php if ($this->session->flashdata('infoUpdateMember')) { ?>
                    <div class="alert alert-success" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('infoUpdateMember'); ?>
                    </div>
                <?php } ?>
<?php if ($this->session->flashdata('infoDeleteMember')) { ?>
                    <div class="alert alert-success" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('infoDeleteMember'); ?>
                    </div>
                <?php } ?>
<?php if ($this->session->flashdata('infoChangePasswordMember')) { ?>
                    <div class="alert alert-success" style="margin: 15px">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('infoChangePasswordMember'); ?>
                    </div>
<?php } ?>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Dob</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listMember as $key => $value) { ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $value['firstname'] ?></td>	
                                    <td><?php echo $value['lastname'] ?></td>
                                    <td><?php echo $value['email'] ?></td>
                                    <td><?php echo $value['gender'] ?></td>
                                    <td><?php echo $value['dob'] ?></td>
                                    <td><?php echo $value['phone'] ?></td>
                                    <td><?php echo (($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Non Active</span>' ); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('backend/c_member/v_member/' . $value['member_id']) ?>" >Edit</a>  
                                        | <a id="delete_mhs" member_id="<?php echo $value['member_id'] ?>" >Delete</td>
                                </tr>  
                            <?php } ?>
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

<!-- Modal-->
<div class="modal fade" id="MyModalUpgradeMhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">File Excel Agent</h4>
            </div>
            <?php echo form_open_multipart('backend/c_member/upg_member', array("id" => "form-data-member", "class" => "form-horizontal", "enctype" => "multipart/form-data", "method" => "POST", "onsubmit" => "return false")); ?>  
            <div class="modal-body"> 
                <div class="form-group">
                    <label class="col-sm-3 control-label">File</label>
                    <div class="col-sm-9" id="">
                        <input type="file" name="file" class="" id="file" onchange="ValidateFileUpload(this, 'file');"/>     

                    </div>
                </div>

                <div class="modal-footer">
                    <span id="btn-agentExcel">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </span>
                    <img id="loading-search" src="<?php echo base_url() ?>assets/backend/img/ajax-loader.gif" style="display: none;" width="30px"/>
                </div>      
            </div>
            <?php echo form_close(); ?>
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
    $(document).on("click", "#delete_mhs", function () {
        var answer = confirm("Are you sure you want to Delete Mahasiswa ID = " + $(this).attr('member_id') + ' ?');
        if (answer) {
            $.ajax({
                type: "POST",
                url: base_url + 'backend/c_member/do_delete',
                data: {id: $(this).attr('member_id')},
                dataType: "json",
                success: function (result) {
                    switch (result.returnVal) {
                        case "success":
                            alert(result.alert);
                            window.location.reload(base_url + 'member');
                            break;
                        default:
                            alert(result.alert);
                            break;
                    }
                }
            });
        }


    })

</script>
