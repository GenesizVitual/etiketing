    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
            </div>   

            <!-- ... Your content goes here ... -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Form Penumpang
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php //echo form_open(site_url('klien/insert'), array('form'=>'role'))?>
                                <form action="#" method="post" id="klien_insert">
                                        <div class="form-group">
                                                <label>No. NIK</label>
                                                <input class="form-control" type="input" name="nik">
                                                <?php echo form_error('nik');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Nama Penumpang</label>
                                                <input class="form-control" type="input" name="nama_klien">
                                                <?php echo form_error('nama_klien');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input class="form-control" type="input" name="tempat_lahir">
                                                <?php echo form_error('tempat_lahir');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input class="form-control" type="date" name="tgl_lahir">
                                                <?php echo form_error('tgl_lahir');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <label>
                                                    <input type="radio" name="jenis_kel"  value="Pria"> Pria
                                                    <input type="radio" name="jenis_kel"  value="Wanita"> Wanita
                                                </label>
                                                <?php echo form_error('jenis_kel');?>
                                        </div>
                                         <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat"></textarea>
                                                <?php echo form_error('alamat');?>
                                        </div>
                                        <div class="form-group">
                                                <label>RT</label>
                                                <input class="form-control" type="input" name="rt">
                                                <?php echo form_error('rt');?>
                                        </div>
                                         <div class="form-group">
                                                <label>RW</label>
                                                <input class="form-control" type="input" name="rw">
                                                <?php echo form_error('rw');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Desa</label>
                                                <input class="form-control" type="input" name="desa">
                                                <?php echo form_error('desa');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input class="form-control" type="input" name="kec">
                                                <?php echo form_error('kec');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Kabupaten</label>
                                                <input class="form-control" type="input" name="kab">
                                                <?php echo form_error('kab');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Pekerjaan</label>
                                                <input class="form-control" type="input" name="pekerjaan">
                                                <?php echo form_error('pekerjaan');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Warga Negara</label>
                                                <select class="form-control" name="warga_negara">
                                                    <option >Pilih Warga Negara</option>
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
                                                </select>
                                                <?php echo form_error('warga_negara');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Status</label>
                                                <label>
                                                    <input type="radio" name="status"  value="kawin" > Kawin
                                                    <input type="radio" name="status"  value="belum kawin" > Belum Kawin
                                                </label>
                                                <?php echo form_error('status');?>
                                        </div>
                                      
                                        <div class="form-group">
                                            <button type="button"  onclick="sendData()"  class="btn btn-success">Tambah</button>
                                            <button type="reset" class="btn btn-danger">Batal</button>
                                        </div>
                                    </form>  
                                <?php //echo form_close();?>
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
    <script type="text/javascript">
           var socket = io.connect( 'http://'+window.location.hostname+':3000' );
        $(document).on('ready', function(){
            sendData = function()
            {
                //alert("test");
                $.ajax({
                    url : "<?php echo site_url('Klien/insert');?>",
                    type : "POST",
                    dataType : "JSON",
                    data : $('#klien_insert').serialize(),
                    success: function(data)
                    {
                        if(data.output== true){
                         
                            socket.emit('total_klien', { 
                                  total_klien: data.total_klien
                            });
                            console.log(socket);
                            window.location.href="<?php echo site_url('Klien');?>";
                        }
                        //   console.log(data);
                    }
                });
            }
        });
    </script>