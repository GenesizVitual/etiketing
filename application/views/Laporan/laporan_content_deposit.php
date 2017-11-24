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
                <div class="col-lg-4" style="padding-bottom: 20px">
                    <label>Masukan Tanggal Awal</label>
                    <input  class="form-control" type="date" name="tgl_awal">                                  
                </div>
                <div class="col-lg-4" style="padding-bottom: 20px">
                    <label>Masukan Tanggal Akhir</label>
                    <input  class="form-control" type="date" name="tgl_akhir">                                  
                </div>
                <div class="col-lg-4" style="padding-bottom: 20px">
                    <label> &nbsp;</label>
                    <button class="form-control btn btn-success" onclick="tombol_print()"> Print </button>                                  
                </div>
            </div>   
            <!-- ... Your content goes here ... -->
             <div class="row" id="table_regist">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <?php echo $title;?>
                            </div>
                            <!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                      <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Registrasi</th>
                                                <th>Kode Barcode</th>
                                                <th>Nama Klien</th>
                                                <th>Pengurus</th>
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
            var notify=false;
                $('#dataTables-example1').DataTable({
                    "ajax":{
                        "url" : "<?php echo site_url('Deposit/table_deposit/')?>"+null,
                        "type" : "POST"
                    }
                });

                 var d = new Date();
                 var now = new Date();
                 var day = ("0" + now.getDate()).slice(-2);
                 var month = ("0" + (now.getMonth() + 1)).slice(-2);
                 var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
                 var tanggal_awal;
                 var tanggal_akhir;

                $('[name="tgl_awal"]').val(today); 
                $('[name="tgl_akhir"]').val(today); 
                tanggal_awal = today;
                tanggal_akhir = today;
        
                $('[name="tgl_awal"]').on('input', function(){
                    //console.log($(this).val());
                   tanggal_awal = $(this).val();   
                });

                $('[name="tgl_akhir"]').on('input', function(){
                    //console.log($(this).val());
                   tanggal_akhir = $(this).val();   
                });

                tombol_print = function()
                {
                    window.open("<?php echo site_url('Deposit/printBaseOnDate/')?>"+tanggal_awal+"|"+tanggal_akhir);
                }
        });      
</script>