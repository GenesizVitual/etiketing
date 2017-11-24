    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
            </div>   

             <div class="row">

                <div class="col-lg-12">
                <?php if(!empty($this->session->flashdata('message_success'))){?>
                     <div class="alert alert-success">
                            <?php echo $this->session->flashdata('message_success');?>
                     </div>
                <?php }?>
                <?php if(!empty($this->session->flashdata('message_fail'))){?>
                     <div class="alert alert-warning">
                            <?php echo $this->session->flashdata('message_fail');?>
                     </div>
                 <?php }?>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12" style="padding-bottom: 20px">
                    <a href="<?php echo site_url('Pelabuhan/form_insert');?>" class="btn btn-outline btn-success col-lg-12">Tambah Pelabuhan</a>
                </div>
            </div>
           
            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Pelabuhan
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pelabuhan</th>
                                                <th>Alamat</th>
                                                <th>Kontrol</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
        </div>
    </div>

  <script>
            $(document).ready(function() {
                $('#dataTables-example1').DataTable({
                    "ajax" : {
                        "url" : "<?php echo site_url('Pelabuhan/get_data')?>",
                        "type": "POST"
                    },responsive: true
                });
            });

            function test_modal()
            {
                $('#modal_print').modal('show');
            }
</script>



<!-- Bootstrap modal Print page -->
<div class="modal fade" id="modal_print" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title title_print">Membahkan Sub uraian</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_sub_sub_uraian" class="form-horizontal">
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave_print_biro" onclick="print_biro()"  class="btn btn-primary">Print Biro</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->