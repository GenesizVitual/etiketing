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
                    <a href="<?php echo site_url('Jenis_tarif/form_insert');?>" class="btn btn-outline btn-success col-lg-12">Tambah Jenis Tarif</a>
                </div>
            </div>
            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Jenis Tarif
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Retribusi</th>
                                                <th>Jenis Tarif</th>
                                                <th>Satuan</th>
                                                <th>Harga satuan</th>
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
                        "url" : "<?php echo site_url('Jenis_tarif/get_data')?>",
                        "type": "POST"
                    },'rowsGroup' : [1]
                    ,responsive: true
                });

                confirm_ = function(id) 
                {
                    if(confirm("Apakah Anda akan menghapus data ini ... ?")== true){
                        window.location.href="<?php echo site_url('Jenis_tarif/delete/')?>"+id;
                    }else{
                        alert("Data Tidak Jadi Dihapus");
                    }
                }
            });
</script>