<div style="padding: 60px 0">
    <div class="container div-shadow">
        <div class="col-md-7">
            <h2 class="tittle">LIST SEMINAR</h2>
            <?php
            foreach ($seminar as $key => $value):
                ?>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table >
                                <tr>
                                    <td>
                                        <a href="#" class="">
                                            <img src="<?php echo $value['poster'] ?>" style="height:140px; width:100px" alt="...">
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <table class="table_margin">
                                            <tr>
                                                <td colspan="3" align="center"><b><?php echo $value['tema'] ?></b><br><br></td>
                                            </tr>
                                            <tr>
                                                <td width="160px">Pembicara</td>
                                                <td width="10px">:</td>
                                                <td><?php echo $value['pembicara'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jadwal</td>
                                                <td>:</td>
                                                <td>
                                                    <?php
                                                    $date = date_create($value['jadwal']);
                                                    $day = date_format($date, "N");
                                                    $array_hari = array(1 => Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu);
                                                    $hari = $array_hari[$day];
                                                    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

                                                    $tahun = substr($value['jadwal'], 0, 4);
                                                    $bulan = substr($value['jadwal'], 5, 2);
                                                    $tgl = substr($value['jadwal'], 8, 2);

                                                    $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
                                                    $pukul = substr($value['jadwal'], 11, 5);
                                                    echo $hari . ', ' . $result . ' - ' . $pukul
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat</td>
                                                <td>:</td>
                                                <td><?php echo $value['tempat'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kuota</td>
                                                <td>:</td>
                                                <td><?php echo $value['kuota'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sisa Kuota</td>
                                                <td>:</td>
                                                <td><?php echo $value['sisa_kuota'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width="160px">Desckripsi</td>
                                                <td width="10px">:</td>
                                                <td><?php echo $value['description'] ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-primary btn-lg" style="display:block; float:right" data-toggle="modal" data-target="#myModal-<?php echo $value['seminar_id'] ?>">Daftar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="myModal-<?php echo $value['seminar_id'] ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Seminar</h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <?php $session_member = $this->session->userdata('CMS_member'); ?>
                                        <table class="table">
                                            <tr>
                                                <td width="160px">Tema Seminar</td>
                                                <td width="10px">:</td>
                                                <td><?php echo $value['tema'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pembicara</td>
                                                <td>:</td>
                                                <td><?php echo $value['pembicara'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jadwal</td>
                                                <td>:</td>
                                                <td><?php echo $value['jadwal'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tempat</td>
                                                <td>:</td>
                                                <td><?php echo $value['tempat'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kuota</td>
                                                <td>:</td>
                                                <td><?php echo $value['kuota'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sisa Kuota</td>
                                                <td>:</td>
                                                <td><?php echo $value['sisa_kuota'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?php echo $session_member['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><?php echo $session_member['firstname'] . ' ' . $session_member['lastname'] ?></td>
                                            </tr>    	
                                            <tr>
                                                <td colspan="3" style="color:red">*Pastikan data member sudah benar, jika belum silahkan ubah data member</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-lg" style="width:100%" onclick="daftar(<?php echo $value['seminar_id'] ?>)">Daftar</button>
                            </div>
                        </div>

                    </div>
                </div>

                <?php
            endforeach;
            ?>
        </div>

    </div>
</div
<div class="footer">
    <div class="container">
        <div class="footer-grids">
            <div class="clearfix"></div>
        </div>
        <p> &copy; 2016 Event Organizer. All Rights Reserved</p>
    </div>
</div> 
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

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
<script src="<?php echo base_url() ?>assets/frontend/js/jquery.event.move.js"></script>
<script>
function daftar(seminar_id) {

    var member_id = "<?php echo $session_member['member_id'] ?>";
    var email_member = "<?php echo $session_member['email'] ?>";

    if (!email_member) {
        alert('Maaf, Anda harus login sebelum mendaftar!');
        location.href = "<?php echo base_url('login?ref='); ?>";
    } else {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('front/seminar/submit_order') ?>",
            data: {
                'email_member': email_member,
                'seminar_id': seminar_id,

            },
            dataType: 'json',
            success: function (results) {
                if (results.status == "success") {
                    alert("Terima kasih, Anda telah terdaftar di seminar");
                    window.location.reload();
                    return true;

                } else if (results.status == "error") {
                    alert(results.alert);
                    window.location.reload();
                } else {
                    alert(results.alert);
                    window.location.reload();
                }

                return false;
            }
        });
    }
}
</script>
