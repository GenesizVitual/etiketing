<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login | E-tiketingApp</title>
  
    <link href="<?php echo base_url().'resource/login/css/font-awsome.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'resource/login/css/font-face.css'?>" rel="stylesheet">

  
      <style>

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url("<?php echo base_url().'resource/login/ferry.jpg'?>");
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(40% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>

  <script src="<?php echo base_url().'resource/login/css/'?>Prefixfree.css"></script>

</head>

<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div> Aplikasi E-tiketing <br> Pelabuhan  Bau Bau </div>
		</div>
		<br>
		<div class="login">
			<?php echo form_open(site_url('Login/login')); ?>
				<input type="text" placeholder="username" name="user"><br> <?php echo form_error('user');?>
				<input type="password" placeholder="password" name="password"><br> <?php echo form_error('password');?>
				<input type="submit" value="Login">
				<div style="padding-top: 10px;">	&copy; Copyright Dishub 2017 All right Reserve</div>

			<?php echo form_close();?>
			<?php if(!empty($this->session->flashdata('message_fail'))) {?>

					<label style="color: #ff0000"><?php echo $this->session->flashdata('message_fail') ?></label>

			<?php }?>
		</div>
  <script src='<?php echo base_url().'resource/login/css/'?>jquery.min.js'></script>

  
</body>
</html>
