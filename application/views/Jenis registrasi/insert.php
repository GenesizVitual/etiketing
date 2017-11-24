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
                                Form Jenis Tarif
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php echo form_open(site_url('Jenis_retribusi/insert'), array('form'=>'role'))?>
                                        <div class="form-group">
                                                <label>Nama Jenis retribusi</label>
                                                <input class="form-control" type="input" name="jenis_retribusi">
                                                <?php echo form_error('jenis_retribusi');?>
                                        </div>
                                        <div class="form-group">
                                                <label>Singkatan</label>
                                                <input class="form-control" type="input" name="singkatan">
                                                <?php echo form_error('singkatan');?>
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