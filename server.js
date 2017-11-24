var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

io.on('connection', function (socket) {

  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', { 
    	new_count_message: data.new_count_message
    });
  });

  socket.on( 'total_klien', function(data){
    io.sockets.emit( 'total_klien', {
      total_klien: data.total_klien
    });
  });  

  socket.on( 'total_registrasi_klien', function(data){
    io.sockets.emit( 'total_registrasi_klien', {
      total_registrasi_klien: data.total_registrasi_klien
    });
  });

  socket.on( 'total_deposit', function(data){
    io.sockets.emit( 'total_deposit', {
      total_deposit: data.total_deposit
    });
  }); 

  socket.on( 'total_retribusi', function(data){
    io.sockets.emit( 'total_retribusi', {
      total_retribusi: data.total_retribusi
    });
  });

});


server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


