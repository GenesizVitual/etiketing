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
                                Form Pengguna
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php echo form_open(site_url('Pengguna/insert'), array('form'=>'role'))?>
                              
                                        <div class="form-group">
                                                <label>Nama</label>
                                                <input class="form-control" type="input" name="nama_user">
                                                <?php echo form_error('nama_user');?>
                                        </div>
                                        <div class="form-group">
                                                <label>NIP</label>
                                                <input class="form-control" type="input" name="nip">
                                                <?php echo form_error('nip');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" type="input" name="username">
                                                <?php echo form_error('username');?>
                                        </div> 
                                        
                                        <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="Password" name="password">
                                                <?php echo form_error('password');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control" name="level">
                                                    <option >Pilih Level Pengguna</option>
                                                    <option value="0"  >Super admin</option>
                                                    <option value="1"  >Register</option>
                                                    <option value="2"  >Front Office</option>
                                                    <option value="3"  >Petugas Dishub</option>
                                                    <option value="4"  >Administrasi</option>
                                                    <option value="5"  >Kepala KPUD</option>
                                                </select>
                                                <?php echo form_error('level');?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Tambah</button>
                                            <button type="reset" class="btn btn-danger">Batal</button>
                                        </div>
                                <?php echo form_close();?>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
        </div>
    </div>