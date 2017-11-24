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

            <!-- ... Your content goes here ... -->
             <div class="row" id="table_regist">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Deposit Klien 
                            </div>
                            <!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Klien</th>
                                                <th>Tanggal Deposit</th>
                                                <th>Jumlah Depost</th>
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
  <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

  <script>
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );
     
    $(document).ready(function() {  

               $(document).ready(function() {
                $('#dataTables-example1').DataTable({
                    "ajax" : {
                        "url" : "<?php echo site_url('Deposit/getData/')?>"+"<?php echo $id_klien?>",
                        "type": "POST"
                    },responsive: true
                });

                confirm_= function(id, id_klien){
                    if(confirm('Apakah anda yakin akan menghapus data ini ... ?')==true){
                        //alert('data terhapus');
                            $.ajax({
                                url: "<?php echo site_url('Deposit/delete/');?>"+id+"/"+id_klien,
                                type: "GET",
                                dataType : "JSON",
                                success : function(data)
                                {
                                    if(data.output == true){
                                        socket.emit('total_deposit', {
                                            total_deposit : data.total_deposit
                                        });
                                        window.location.href="<?php echo site_url('Deposit/lihat_deposit/')?>"+data.id;
                                    }
                                }
                            });
                    }else{
                        alert('data tidak terhapus');
                    }
                }
            });
    });      
</script>