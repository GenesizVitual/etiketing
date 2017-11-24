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
                                <?php echo form_open(site_url('Rute/update'), array('form'=>'role'))?>
                                        <input type="hidden" name="id" value="<?php echo $data->id;?>">
                                         <div class="form-group">
                                                <label>Kapal</label>
                                                <select class="form-control" name="kapal">
                                                    <option >Pilih Jenis Kapal</option>
                                                    <?php foreach($kapal->result() as $kapal) {?>
                                                        <option value="<?php echo $kapal->id?>" <?php if($data->kapal_id== $kapal->id){?> selected <?php } ?>><?php echo $kapal->nama_kapal?></option>
                                                    <?php }?>
                                                </select>
                                                <?php echo form_error('kapal');?>
                                        </div>
                                         <?php $awalTujuan = explode('-', $data->rute);?>

                                        <div class="form-group">
                                                <label>Awal</label>
                                                <input class="form-control" type="input" name="awal" value="<?php echo $awalTujuan[0]?>">
                                                <?php echo form_error('awal');?>
                                        </div>

                                        <div class="form-group">
                                                <label>Tujuan</label>
                                                <input class="form-control" type="input" name="tujuan" value="<?php echo $awalTujuan[1]?>">
                                                <?php echo form_error('tujuan');?>
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