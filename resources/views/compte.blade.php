<?php if (Auth::check()) { ?>
<?php 
	$accueil = '/accueil';
	$logout = '/Users/logout';
	$compte = '/mon_compte';
	$add = '/add';
	$messagerec = 'message_recu';
	$messageenv = 'message_envoye';
	
	$infosUser = array( 
		'username' => Auth::user()->username,
		'firstname' => Auth::user()->firstname,
		'id' => Auth::user()->id,
		'lastname' => Auth::user()->lastname,
		'email' => Auth::user()->email,
		'birthdate' => Auth::user()->birthdate
		);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php echo Html::style('../resources/assets/css/style.css') ?>
		<title>Mon compte</title>
	</head>
	<body>
		<div id="top">
			<ul>
				<li><?php echo Html::link($accueil, 'Accueil') ?></li>
				<li><?php echo Html::link($compte, 'Mon compte') ?></li>
				<li><?php echo Html::link($add, 'Ajouter une annonce') ?></li>
				<li><?php echo Html::link($messagerec, 'Message recu') ?></li>
				<li><?php echo Html::link($messageenv, 'Message envoyé') ?></li>
				<li><?php echo Html::link($logout, 'Deconnexion') ?></li>
			</ul>
		</div>
		<div id="container">
			@if (Session::has('message'))
			<div id="message_success">
					<p>{{ Session::get('message') }}</p>
			</div>
			@endif
			<div id="mes_infos">
				<h2>Modification compte</h2>
				<?php 
					echo Form::open(array('action' => 'UsersController@modification'));

						echo Form::label('lastname', 'Nom');
						echo Form::text('lastname', $infosUser['lastname']);

						echo Form::label('firstname', 'Prenom');
						echo Form::text('firstname', $infosUser['firstname']);

						echo Form::label('email', 'E-Mail Address');
						echo Form::email('email', $infosUser['email']);
						
						echo Form::submit('Modifier');
					echo Form::close();
				?>
				<?php echo Html::link('Users/'. $infosUser['id'] . '/delete', 'Désactiver compte') ?>
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
<?php } else { echo "Vous n'avez pas accès a cette page"; } ?>