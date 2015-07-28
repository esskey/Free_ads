<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php echo Html::style('../resources/assets/css/style.css') ?>
		<title>Bienvenue</title>
	</head>
	<body>
		<div id="container">
			@if (Session::has('message'))
			<div id="message_success">
					<p>{{ Session::get('message') }}</p>
			</div>
			@endif
			
			<div id="form_connexion">
				<?php 
				echo Form::open(array('action' => 'UsersController@login'));
					echo Form::text('username');
					echo Form::password('password');
					echo Form::submit('se connecter');
				echo Form::close();
				?>

				<?php echo Html::link('/signin', 's\'inscrire') ?>
			</div>
			@if ($errors->any())
			<div id="erreurs">
				@foreach ( $errors->all() as $error )
					<p>{{ $error }}</p>
				@endforeach
			</div>
			@endif
		</div>
	</body>
</html>