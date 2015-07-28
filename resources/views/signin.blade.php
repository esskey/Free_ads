<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php echo Html::style('../resources/assets/css/style.css') ?>
		<title>Inscription</title>
	</head>
	<body>
		<div id="container">
			<div id="form_inscription">
				<h2>Signin</h2>
				<?php 
					echo Form::open(array('action' => 'UsersController@create'));
						echo Form::label('username', 'Pseudo');
						echo Form::text('username');
						
						echo Form::label('password', 'mot de passe');
						echo Form::password('password');

						echo Form::label('lastname', 'Nom');
						echo Form::text('lastname');

						echo Form::label('firstname', 'Prenom');
						echo Form::text('firstname');

						echo Form::label('birthdate', 'Date de naissance');
						echo Form::date('birthdate');

						echo Form::label('email', 'E-Mail Address');
						echo Form::email('email', 'test@gmail.com');
						
						echo Form::submit('s\'inscrire');
					echo Form::close();
				?>

				<?php echo Html::link('/login', 'se connecter') ?>
			</div>
			@if ($errors->any())
			<div id="erreurs">
				@foreach ( $errors->all() as $error )
					<p>{{ $error }}</p>
				@endforeach
			</div>
			@endif

			@if (Session::has('message'))
    		<div class="alert alert-info">
    			<p>{{ Session::get('message') }}</p>
    		</div>
			@endif
		</div>
	</body>
</html>