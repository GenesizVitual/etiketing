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
                                Form Kapal
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php echo form_open(site_url('Jenis_kapal/update'), array('form'=>'role'))?>
                                        <input type="hidden" name="id" value="<?php echo $data->id?>">
                                        <div class="form-group">
                                                <label>Nama Kapal</label>
                                                <input class="form-control" type="input" name="nama_kapal" value="<?php echo $data->nama_kapal;?>">
                                                <?php echo form_error('nama_kapal');?>
                                        </div>
                                         <div class="form-group">
                                                <label>Kapasitas Penumpang</label>
                                                <input class="form-control" type="input" name="kapasitas_penumpang" value="<?php echo $data->kapasitas_penumpang?>">
                                                <?php echo form_error('kapasitas_penumpang');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Tahun Pembuatan</label>
                                                <input class="form-control" type="input" name="thn_pembuatan" value="<?php echo $data->thn_pembuatan?>">
                                                <?php echo form_error('thn_pembuatan');?>
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