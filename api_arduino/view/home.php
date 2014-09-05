<!DOCTYPE html>
<html>
<head>
	<title>API Arduino</title>
	<!-- Latest compiled and minified CSS & JS -->

	<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
<br>
<br>
<br>
<div class="row ">
	<div class="col-sm-4 col-sm-offset-4">
		<?php $this->printMessage(); ?>
		<form action="/api_arduino/toggleInterruptor" method="post" role="form">
			<legend>Update arduino</legend>
			
			<div class="form-group">
				<label for="">ID Arduino</label>
				<input type="text" class="form-control" value="11110000"  readonly="readonly">
			</div>
			<div class="form-group">
				<label for="">ID Interruptor</label>
				<input type="text" class="form-control" value="1101" readonly="readonly">
			</div>
			<div class="form-group">
				<label for="">Sensores</label>
				<input type="text" class="form-control" value="<?php echo $registro['sensores'] ?>" readonly="readonly"	>
			</div>
			<div class="form-group">
				<label for="">Chave</label>
				<div class="radio">
					<label>
						<input type="radio" value="1" name="controle" <?php if ($registro['controle']) echo "checked"; ?> >
						Ligado
					</label>
				</div><div class="radio">
					<label>
						<input type="radio" value="0" name="controle" <?php if (!$registro['controle']) echo "checked"; ?> >
						Desligado
					</label>
				</div>
			</div>
		
			
		
			<button type="submit" onclick="updateInterruptor()" class="btn pull-right btn-primary">Ligar/Desligar</button>
		</form>
	</div>
</div>
</body>
</html>