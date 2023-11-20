
</div>
        <input type="hidden" name="actualLink" value="<?php// echo $model_menu->actualLink(); ?>">
        <script type="text/javascript">
            $(document).ready(function(){
                menuActive();
            });

            function menuActive() {
                var actualLink = $('input[name="actualLink"]').val();
                $('.nav-sidebar a[href="'+actualLink+'"]').addClass('active');
                $($('.nav-sidebar a[href="'+actualLink+'"]').closest('.nav-parent')).children().addClass('active');
                $($('.nav-sidebar a[href="'+actualLink+'"]').closest('.nav-parent')).addClass('menu-open');
            }
        </script>
        <div id="modal_error" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Notifikasi Error</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2022-<?=date('Y')?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <style type="text/css">
            .control-sidebar .nav-item p{
                color: white;
            }
            .control-sidebar .nav-item i{
                color: white;
            }
        </style>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/dist/js/adminlte.min.js'); ?>"></script>
    <!-- <script src="<?php //echo base_url('asset/plugins/sweetalert2-10.7.0/package/dist/sweetalert2.min.js'); ?>"></script> -->
    <!-- <script src="<?php //echo base_url('asset/plugins/toast/jquery.toast.min.js'); ?>"></script> -->
    <script src="<?php echo base_url('asset/plugins/select2/js/select2.full.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/plugins/moment/moment.min.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- <script src="<?php //echo base_url('asset/plugins/bootstrap-datepicker/bootstrap-datepicker.js');?>"></script> -->
    <script src="<?php echo base_url('asset/plugins/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js');?>"></script>
    <!-- <script src="<?php// echo base_url('asset/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>"></script> -->
    <!-- <script src="<?php //echo base_url('asset/dist/js/custom.js'); ?>"></script> -->
    <!-- <script src="<?php //echo base_url('asset/plugins/fontawesome-free-6.4.0/js/fontawesome.min.js'); ?>"></script> -->

    
    <script src="<?php echo base_url('asset/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?php echo base_url('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
    <!-- <script src="<?php //echo base_url('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?php //echo base_url('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>  
    <script src="<?php //echo base_url('asset/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?php //echo base_url('asset/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?php //echo base_url('asset/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script> -->
    <script src="<?php echo base_url('asset/js/notify.min.js')?>"></script>
    <script src="<?php echo base_url('asset/js/ajax.js')?>"></script>
</body>
</html>
