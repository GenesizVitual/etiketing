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
                    <label>Masukan Kode Barcode</label>
                    <input class="form-control" type="input" name="nik">                                  
                </div>
            </div>   
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
                                                <th>Nik</th>
                                                <th>Klien</th>
                                                <th>Kode Barcode</th>
                                                <th>TTL</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>RT/RW</th>
                                                <th>Desa</th>
                                                <th>Kec</th>
                                                <th>Kab</th>
                                                <th>Pekerjaan</th>
                                                <th>Warga negara</th>
                                                <th>Satus</th>
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
               $('#table_regist').hide();
                // $('#dataTables-example1').DataTable({
                //     "ajax" : {
                //         "url" : "<?php echo site_url('Registrasi/get_data')?>",
                //         "type": "POST"
                //     },responsive: true
                // });

                $('[name="nik"]').on('input', function(){
                    table_ub($(this).val());
                });

                      table_sub = $('#dataTables-example1').DataTable({
                            data:[],
                            columns:[
                            { "data" :"0" },
                            { "data" :"1" },
                            { "data" :"2" },
                            { "data" :"3" },
                            { "data" :"4" },
                            { "data" :"5" },
                            { "data" :"6" },
                            { "data" :"7" },
                            { "data" :"8" },
                            { "data" :"9" },
                            { "data" :"10" },
                            { "data" :"11" },
                            { "data" :"12" },
                            { "data" :"13" },
                            { "data" :"14" },
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
                            url: "<?php echo site_url('Klien/get_data/')?>"+kode_barcode,
                            type : "POST",
                            dataType : "JSON"
                          }).done(function(result){
                             console.log(result); 
                            table_sub.clear().draw();
                            table_sub.rows.add(result.data).draw();
                             $('#table_regist').show(1000);
                           // table_sub.api().ajax.reload(null, false);
                            
                            //reload_sub_table();
                          }).fail(function(jqXHR, textStatus,errorThrown){

                          });
                         
                    }

                      proses_registrasi = function(id){
                $.ajax({
                    url  : "<?php echo site_url('Registrasi/register/')?>"+id,
                    type : "GET",
                    dataType : "JSON",
                    success: function(data)
                    {   
                        if(data.output == true)
                        {
                            socket.emit('total_registrasi_klien',{
                                total_registrasi_klien : data.total_registrasi_klien
                            });
                            window.location.href="<?php echo site_url('Registrasi/Data')?>";
                        }else{
                              window.location.href="<?php echo site_url('Registrasi/Data')?>";
                        }
                    }
                    });
                }

            });      
</script>