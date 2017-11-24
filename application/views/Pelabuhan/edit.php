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
                                Form Pelabuhan
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php echo form_open(site_url('pelabuhan/update'), array('form'=>'role'))?>
                                    <input type="hidden" name="id" value="<?php echo $data->id;?>">
                                        <div class="form-group">
                                                <label>Nama Pelabuhan</label>
                                                <input class="form-control" type="input" name="pelabuhan" value="<?php echo $data->nama_pelabuhan; ?>">
                                                <?php echo form_error('pelabuhan');?>
                                        </div>
                                         <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat_pel"><?php echo $data->alamat_pel?></textarea>
                                                <?php echo form_error('alamat_pel');?>
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