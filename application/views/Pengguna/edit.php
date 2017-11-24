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
                                <?php echo form_open(site_url('Pengguna/update'), array('form'=>'role'))?>
                                        <input type="hidden" name="id" value="<?php echo $data->id;?>">
                                        <div class="form-group">
                                                <label>Nama</label>
                                                <input class="form-control" type="input" name="nama_user" value="<?php echo $data->nama_user?>">
                                                <?php echo form_error('nama_user');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Nip</label>
                                                <input class="form-control" type="input" name="nip" value="<?php echo $data->nip?>">
                                                <?php echo form_error('nip');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" type="input" value="<?php echo $data->username;?>" name="username">
                                                <?php echo form_error('username');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="Password"  name="password">
                                                <?php echo form_error('password');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control" name="level">
                                                    <option >Pilih Level Pengguna</option>
                                                    <option value="0" <?php if($data->level==0) { ?> selected <?php }?> >Super admin</option>
                                                    <option value="1" <?php if($data->level==1) { ?> selected <?php }?> >Register</option>
                                                    <option value="2" <?php if($data->level==2) { ?> selected <?php }?> >Front Office</option>
                                                    <option value="2" <?php if($data->level==3) { ?> selected <?php }?> >Petugas Dishub</option>
                                                    <option value="2" <?php if($data->level==4) { ?> selected <?php }?> >Administrasi</option>
                                                    <option value="2" <?php if($data->level==5) { ?> selected <?php }?> >Kepala KPUD</option>
                                                </select>
                                                <?php echo form_error('level');?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Ubah</button>
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
