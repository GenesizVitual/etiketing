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
            <?php if($this->session->level_user==1 or $this->session->level_user==0 ){?>
            <div class="row">
                <div class="col-lg-12" style="padding-bottom: 20px">
                    <label>Masukan Kode Barcode</label>
                    <input class="form-control" type="input" name="nik">                                  
                </div>
            </div>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-lg-12" style="padding-bottom: 20px">
                         <div class="alert alert-warning">
                           Account anda tidak dapat mengoperasikan Halaman ini
                         </div>
                    </div>
                </div>
            <?php }?>
            <!-- ... Your content goes here ... -->
             <div class="row" id="table_regist">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Data Klien
                            </div>
                            <!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Klien</th>
                                                <th>Kode Barcode</th>
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

                $('[name="nik"]').on('input', function(){
                    table_ub($(this).val());
                   //console.log($(this).val());
                });

                     table_sub = $('#dataTables-example1').DataTable({
                            data:[],
                            columns:[
                            { "data" :"0" },
                            { "data" :"1" },
                            { "data" :"2" },
                            { "data" :"3" },
                            ], rowCallback: function(row, data){},
                            filter:false,
                            pagging :true,
                            searching: true,
                            info: true,
                            ordering: true,
                            processing: true,
                            retrieve:true
                        }); 

                    table_ub = function(kode_barcode){
                          $.ajax({
                            url: "<?php echo site_url('Deposit/get_data/')?>"+kode_barcode,
                            type : "POST",
                            dataType : "JSON"
                          }).done(function(result){
                             console.log(result); 
                            table_sub.clear().draw();
                            table_sub.rows.add(result.data).draw();
                            $('#table_regist').show(1000); 
                            //reload_sub_table();
                          }).fail(function(jqXHR, textStatus,errorThrown){

                          });
                         
                    }

    });      
</script>