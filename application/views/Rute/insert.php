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
                                Form Rute
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php echo form_open(site_url('Rute/insert'), array('form'=>'role'))?>

                                        <div class="form-group">
                                                <label>Kapal</label>
                                                <select class="form-control" name="kapal">
                                                    <option >Pilih Jenis Kapal</option>
                                                    <?php foreach($kapal->result() as $kapal) {?>
                                                        <option value="<?php echo $kapal->id?>"  ><?php echo $kapal->nama_kapal?></option>
                                                    <?php }?>
                                                </select>
                                                <?php echo form_error('kapal');?>
                                        </div>
                                       
                                        <div class="form-group">
                                                <label>Awal</label>
                                                <input class="form-control" type="input" name="awal" >
                                                <?php echo form_error('awal');?>
                                        </div>

                                        <div class="form-group">
                                                <label>Tujuan</label>
                                                <input class="form-control" type="input" name="tujuan" >
                                                <?php echo form_error('tujuan');?>
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