    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                     <div class="alert alert-success">
                        Selamat Datang <strong><?php echo $this->session->name_user;?> </strong>. Sistem Telah Siap untuk Bekerja.
                     </div>
                </div>
            </div>
            <div class="row">
                  <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3"><i class="fa fa-fw fa-5x" aria-hidden="true" title="Copy to use cc-mastercard">&#xf1f1</i>
                                        
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="total_klien"><?php echo $total_klien;?></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Jumlah Pemilik Kartu</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                       <i class="fa fa-fw fa-5x" aria-hidden="true" title="Copy to use credit-card-alt"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="total_registrasi_klien"><?php echo $total_registrasi_klien;?></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Kartu telah teregistrasi</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                       <i class="fa fa-fw fa-5x" aria-hidden="true" title="Copy to use dollar"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="total_deposit"><?php echo number_format($total_deposit,0,',',',');?></div>
                                       
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Deposit</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                      <i class="fa fa-fw fa-5x" aria-hidden="true" title="Copy to use dollar"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="total_retribusi"><?php echo number_format($total_retribusi,0,',',',');?></div>
                    
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Retribusi</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                     <h1 class="page-header">Grafik Retribusi</h1>
                     <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
            <!-- ... Your content goes here ... -->
        </div>
    </div>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
    <script type="text/javascript">
       
     
         var socket = io.connect( 'http://'+window.location.hostname+':3000' );
         socket.on('total_klien', function(data){
             $( "#total_klien" ).html( numberWithCommas(data.total_klien) );
         });
         socket.on('total_registrasi_klien', function(data){
             $( "#total_registrasi_klien" ).html( numberWithCommas(data.total_registrasi_klien) );
         });

         socket.on('total_deposit', function(data){
             $( "#total_deposit" ).html( numberWithCommas(data.total_deposit) );
         }); 
         socket.on('total_retribusi', function(data){
             $( "#total_retribusi" ).html( numberWithCommas(data.total_retribusi) );
         });

         function numberWithCommas(x) {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }

           var sdd = [
            { year: '2008', value: 20 },
          ];

          $(document).on('ready', function(){

                  
                 $.ajax({
                    url : "<?php echo site_url('Welcome/get_chart')?>",
                    dataType:"JSON",
                    success : function(data){
                       // console.log(data);
                       var Container ={};
                       var vs =[];
                       var vsd =[];

                        $.each(data, function(index, element){
                            //Container['year'+index]=element.year;
                            //Container['value'+index]=parseInt(element.value);
                            vs[index] = {'year':element.year, 'value':parseInt(element.value)};
                           // console.log(Container);
                        });
                        console.log(vs);
                        //console.log(vs);
                        //console.log(vs);
                         new Morris.Line({
                          // ID of the element in which to draw the chart.
                          element: 'myfirstchart',
                          // Chart data records -- each entry in this array corresponds to a point on
                          // the chart.
                          data: vs,
                          // The name of the data record attribute that contains x-values.
                          xkey: 'year',
                          // A list of names of data record attributes that contain y-values.
                          ykeys: ['value'],
                          // Labels for the ykeys -- will be displayed when you hover over the
                          // chart.
                          labels: ['Value']
                        });
       
                    }
                 });
                 
                
          });

         
       
    </script>