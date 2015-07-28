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
		<title>Publication annonce</title>
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
			<div id="form_annonces">
				<h2>Ajouter une annonce</h2>
				<?php 
					echo Form::open(array('action' => 'AnnoncesController@create', 'files'=>true));
						echo Form::text('titre', null, array('placeholder' => 'Titre'));
						
						echo Form::textarea('description');

						echo Form::file('image[]', array('multiple'=>true));
						
						echo Form::text('prix', null, array('placeholder' => 'Votre prix en €'));

						echo Form::select('categorie', array(
							'vehicules' => 'Véhicules', 
							'immobilier' => 'Immobilier',
							'multimedia' => 'Multimedia'), 'Véhicules');
						
						echo Form::submit('Add');
					echo Form::close();
				?>
			</div>
			@if ($errors->any())
			<div id="erreurs">
				@foreach ( $errors->all() as $error )
					<p>{{ $error }}</p>
				@endforeach
			</div>
			@endif

			@if (Session::has('message'))
			<div id="message">
					<p>{{ Session::get('message') }}</p>
			</div>
			@endif
		</div>
	</body>
</html>
<?php } else { echo "Vous n'avez pas accès a cette page"; } ?>