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
            <?php if($this->session->level_user==2 or $this->session->level_user==0){?>
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
                        <label>Account Anda Tidak Dapat Mengoperasikan Halaman Ini</label>
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

            <div class="row" id="table_tiket">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Retribusi Hari ini
                                <a href="#" id="id_cetak"> Cetak struk pembayaran </a>
                                <label style="padding-left: 55%">Tanggal <?php $date = date('Y-m-d', time()); $tgl_explode = explode("-", $date); echo $tgl_explode[2].'-'.$tgl_explode[1].'-'.$tgl_explode[0];?></label>
                            </div>
                            <!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Klien</th>
                                                <th>Kode Barcode</th>
                                                <th>Tanggal beli</th>
                                                <th>Quantitas</th>
                                                <th>Jenis Tarif</th>
                                                <th>Harga tarif</th>
                                                <th>Jumlah Total</th>
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

                $('[name="nik"]').on('input', function(){
                    table_ub($(this).val());
                    table_ub2($(this).val());
                    ganti_url($(this).val());
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
                            url: "<?php echo site_url('Beli_tiket/get_data/')?>"+kode_barcode,
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


                    table_sub2 = $('#dataTables-example2').DataTable({
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
                            ], rowCallback: function(row, data){},
                            filter:false,
                            pagging :true,
                            searching: true,
                            info: true,
                            ordering: true,
                            processing: true,
                            retrieve:true
                        }); 

                    table_ub2= function(kode_barcode){
                          $.ajax({
                            url: "<?php echo site_url('Beli_tiket/get_tiket/')?>"+kode_barcode,
                            type : "POST",
                            dataType : "JSON"
                          }).done(function(result){
                             console.log(result); 
                            table_sub2.clear().draw();
                            table_sub2.rows.add(result.data).draw();
                            $('#table_tiket').show(1000);

                            //reload_sub_table();
                          }).fail(function(jqXHR, textStatus,errorThrown){

                          });
                         
                    }

                    hapus_deposit=function(id) // hapus retribusi
                    {
                        if(confirm('Apakah Anda yakin Ingin Menghapus Data Ini .... ?')==true){
                            $.ajax({
                                url : "<?php echo site_url('Beli_tiket/hapus/')?>"+id,
                                type : "GET",
                                dataType : "JSON",
                                success :function(data)
                                {
                                     if(data.output == true){
                                        socket.emit('total_retribusi', {
                                            total_retribusi : data.total_retribusi
                                        });
                                        console.log(data);
                                       //window.location.href="<?php echo site_url('Beli_tiket');?>";
                                    }
                                }
                            });
                        }else{
                            alert('data tidak terhapus');
                        }
                    }

                    ganti_url = function(Barcode){
                        $.ajax({
                            url: "<?php echo site_url('klien/cek_klien/')?>"+Barcode,
                            type : "POST",
                            dataType : "JSOn",
                            success : function(data){
                                if(data != null){
                                    $('#id_cetak').attr('href','<?php echo site_url("Beli_tiket/cetak_tiket_x/")?>'+data.id_klien);
                                }else{
                                    $('#id_cetak').attr('href','#');
                                }
                            }
                        });
                    }

    });      
</script>