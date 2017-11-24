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
                                <?php echo form_open(site_url('Jenis_tarif/insert'), array('form'=>'role'))?>
                                        <div class="form-group">
                                                <label>Jenis Retribusi</label>
                                                <select class="form-control" name="id_jt">
                                                    <option >Pilih Retribusi</option>
                                                    <?php foreach($retribusi->result() as $key){?>
                                                    <option value="<?php echo $key->id?>"><?php echo $key->jenis_retribusi?></option>
                                                    <?php }?>
                                                </select>
                                                <?php echo form_error('id_jt');?>
                                        </div>

                                        <div class="form-group">
                                                <label>Jenis Tarif</label>
                                                <input class="form-control" type="input" name="jenis_tarif">
                                                <?php echo form_error('jenis_tarif');?>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label>Satuan</label>
                                                <input class="form-control" type="input" name="satuan">
                                                <?php echo form_error('satuan');?>
                                        </div> 
                                        <div class="form-group">
                                                <label>Harga Satuan</label>
                                                <input class="form-control" type="input" name="harga_tarif">
                                                <?php echo form_error('harga_tarif');?>
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