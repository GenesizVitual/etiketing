 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Etiketing Apps</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $this->session->name_user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
  
                    <li><a href="<?php echo site_url('Login/log_of')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="<?php echo site_url('Welcome')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <?php if($this->session->level_user !=3){?>
                    <li>
                        <a href="#2"><i class="fa fa-sitemap fa-fw"></i>Data Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if($this->session->level_user==0){?>
                            <li>
                                <a href="<?php echo site_url('Pengguna');?>">Pengguna</a>
                            </li>
                            <?php }?>
                           <!--  <li>
                                <a href="<?php echo site_url('Pelabuhan');?>">Pelabuhan</a>
                            </li> -->
                             <li>
                                <a href="<?php echo site_url('Klien');?>">Penumpang</a>
                            </li>
                          <!--   <li>
                                <a href="<?php echo site_url('Jenis_kapal');?>">Kapal</a>
                            </li> -->
                            <li>
                                <a href="<?php echo site_url('Jenis_retribusi')?>">Jenis Retribusi</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Jenis_tarif')?>">Jenis Tarif</a>
                            </li>
                           <!--  <li>
                                <a href="<?php echo site_url('Rute')?>">Rute</a>
                            </li>  -->
                            <li>                                
                                <a href="#3">Registrasi <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                       <a href="<?php echo site_url('Registrasi')?>">Registrasi Kartu</a>
                                    </li>
                                    <li>
                                       <a href="<?php echo site_url('Registrasi/Data')?>">Lihat Data Registrasi</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Deposit')?>">Deposit</a>
                            </li> 
                            <li>
                                <a href="<?php echo site_url('Beli_tiket')?>">Retribusi dan Beli Tiket</a>
                            </li> 
                        </ul>
                    </li> 
                    <?php }?>

                    <li>
                        <a href="#4"><i class="fa fa-sitemap fa-fw"></i>Laporan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <?php if($this->session->level_user==1 or $this->session->level_user==0 or $this->session->level_user==3){?>
                            <li>
                                <a href="<?php echo site_url('Registrasi/print_daftar'); ?>">Laporan Registrasi</a>
                            </li>  
                            <li>
                                <a href="<?php echo site_url('Deposit/print_daftars'); ?>">Laporan Deposit</a>
                            </li>
                           <?php }?>

                           <?php if($this->session->level_user==2 or $this->session->level_user==3 or $this->session->level_user==0){?>
                            <li>
                                <a href="<?php echo site_url('Beli_tiket/print_daftarS');?>">Laporan Retribusi</a>
                            </li>
                            <?php }?>                           
                        </ul>
                    </li>     
                    <li>
                        <a href="#5"><i class="fa fa-sitemap fa-fw"></i>Database<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <?php if($this->session->level_user==1 or $this->session->level_user==0 or $this->session->level_user==3){?>
                            <li>
                                <a href="javascript:void(0);" onclick="modal_backup()">Backup database</a>
                            </li>  
                            <li>
                                <a href="javascript:void(0);" onclick="modal_restore()">Restore Database</a>
                            </li>
                           <?php }?>                           
                        </ul>
                    </li>



                    <!--  <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>

            </div>
        </div>
    </nav>

<!-- End Bootstrap modal -->

<div class="modal fade" id="modal_backup" role="dialog">
  <?php 

    $back_url = $this->uri->uri_string();
    $key = 'referrer_url_key';
    $this->session->set_flashdata($key, $back_url);

  ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title title_print">Backup database</h3>
            </div>
            <div class="modal-body form">
             <div>
               <label>Tekan tombol backup untuk membackup database E-Tiketing</label>
             </div>  
            </div>
             <div class="modal-footer">
                <button type="button" id="btnSave_print_biro" onclick="backup_database()"  class="btn btn-primary">Backup</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Bootstrap modal Print page -->
<div class="modal fade" id="modal_restore" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title title_restore">Restore database</h3>
            </div>
            <div class="modal-body form">
             <div>
               <form action="#" id="form_restore" > 
                  <div class="form-group has-feedback" id="files">

                  </div>
               </form>
             </div>  
            </div>
             <div class="modal-footer">
                <button type="button" id="btnSave_print_biro" onclick="restore_database()"  class="btn btn-primary">Backup</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
  
  function modal_backup()
  {
      $('.title_print').text("Modal Backup Database");
      $('#modal_backup').modal('show');
  }

  function modal_restore()
  {
      $('.title_restore').text("Modal Restore Database");
      readFiles();
      $('#modal_restore').modal('show');
  }

  function backup_database(){     
      swal({title:"Process", text: "Process Backup Database",type:"warning"}, function(){
         window.location.href = "<?php echo site_url('Database/backupdb')?>"; 
      });    
  }

  
   function restore_database(){

     // var formData = new FormData($('#form_restore')[0]);

       $.ajax({
        url: "<?php echo site_url('Database/restoredb')?>",
        type: "POST",
        data : $('#form_restore').serialize() ,
        dataType: "JSON",
        success: function(data){
          console.log(data);
          swal({title:"Process", text: "Process restore Database",type:"warning"}, function(){
              //location.reload();
          }); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
         console.log(textStatus);
        }
      }); 
  }

  function readFiles() {
      var fileNames = new Array();
      $.ajax({
          url : "<?php echo base_url().'/backup/files/'?>",
          success: function (data) {
              var li ="";
              $(data).find("td > a").each(function(){
                  if(openFile($(this).attr("href"))){
                      fileNames.push($(this).attr("href"));
                     li+="<li><input type='radio' name='nameFiles' value='"+$(this).attr("href")+"'> "+ $(this).attr("href")+"  </li>";
                  }
              });
              $('#files').html("<ul>"+li+"</ul>");
              console.log(fileNames);
          }
      });

  }

  function openFile(file) {
      var extension = file.substr( (file.lastIndexOf('.') +1) );
      switch(extension) {
          case 'zip':
          case 'rar':
              return true;
              break;
          default:
              return false;
      }
  };
</script>