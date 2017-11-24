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
                                <?php echo form_open(site_url('Klien/update'), array('form'=>'role'))?>
                                        <input type="hidden" name="id" value="<?php echo $data->id_klien;?>"> 
                                        <div class="form-group">
                                                <label>Kode ID Card</label>
                                                <input class="form-control" type="input" name="kode_barcode" value="<?php echo $data->kode_barcode;?>" readonly>
                                                <?php echo form_error('nik');?>
                                        </div>  
                                        <div class="form-group">
                                                <label>No. NIK</label>
                                                <input class="form-control" type="input" name="nik" value="<?php echo $data->nik;?>">
                                                <?php echo form_error('nik');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Nama Penumpang</label>
                                                <input class="form-control" type="input" name="nama_klien" value="<?php echo $data->nama_klien;?>">
                                                <?php echo form_error('nama_klien');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input class="form-control" type="input" name="tempat_lahir" value="<?php echo $data->tempat_lahir;?>">
                                                <?php echo form_error('tempat_lahir');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $data->tgl_lahir;?>">
                                                <?php echo form_error('tgl_lahir');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <label>
                                                    <input type="radio" name="jenis_kel"  value="Pria" <?php if($data->jenis_kel=="Pria"){ ?> checked <?php }?>> Pria
                                                    <input type="radio" name="jenis_kel"  value="Wanita"  <?php if($data->jenis_kel=="Wanita"){ ?> checked <?php }?>> Wanita
                                                </label>
                                                <?php echo form_error('jenis_kel');?>
                                        </div>
                                         <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat"><?php echo $data->alamat;?></textarea>
                                                <?php echo form_error('alamat');?>
                                        </div>
                                        <div class="form-group">
                                                <label>RT</label>
                                                <input class="form-control" type="input" name="rt" value="<?php echo $data->rt;?>">
                                                <?php echo form_error('rt');?>
                                        </div>
                                         <div class="form-group">
                                                <label>RW</label>
                                                <input class="form-control" type="input" name="rw" value="<?php echo $data->rw;?>">
                                                <?php echo form_error('rw');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Desa</label>
                                                <input class="form-control" type="input" name="desa" value="<?php echo $data->desa;?>">
                                                <?php echo form_error('desa');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input class="form-control" type="input" name="kec" value="<?php echo $data->kec;?>">
                                                <?php echo form_error('kec');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Kabupaten</label>
                                                <input class="form-control" type="input" name="kab" value="<?php echo $data->kab;?>">
                                                <?php echo form_error('kab');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Pekerjaan</label>
                                                <input class="form-control" type="input" name="pekerjaan" value="<?php echo $data->pekerjaan;?>">
                                                <?php echo form_error('pekerjaan');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Warga Negara</label>
                                                <select class="form-control" name="warga_negara">
                                                    <option >Pilih Warga Negara</option>
                                                    <option value="WNI" <?php if($data->warga_negara=="WNI"){?> selected <?php }?>>WNI</option>
                                                    <option value="WNA" <?php if($data->warga_negara=="WNA"){?> selected <?php }?>>WNA</option>
                                                </select>
                                                <?php echo form_error('warga_negara');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Status</label>
                                                <label>
                                                    <input type="radio" name="status"  value="kawin"  <?php if($data->status=="kawin"){ ?> checked <?php }?>> Kawin
                                                    <input type="radio" name="status"  value="belum kawin" <?php if($data->status=="belum kawin"){ ?> checked <?php }?> > Belum Kawin
                                                </label>
                                                <?php echo form_error('status');?>
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