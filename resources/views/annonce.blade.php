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
		<title>Annonce</title>
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

			@foreach ($annonce_infos as $value)
			<div id="mon">
				<div class="haut">
    				<h2><?php echo $value->titre ?> <span class="prix"><?php echo $value->prix ?> €</span></h2>
    				<p class="createda">publier le <?php echo $value->created_at; ?> par <span class="bya"> <?php echo $value->username; ?></span></p>
    			</div>
					<div class="photoz">
						
		    			@foreach ($annonce_photo as $valuedos)
		  					<a href="<?php echo '../../storage/'.$value->user_id.'/'.$value->id.'/'.$valuedos->nom ?>" Target= "_blank" title=""><?php echo Html::image('../storage/'.$value->user_id.'/'.$value->id.'/'.$valuedos->nom, "") ?></a>
		  				@endforeach
					</div>
		  			<div class="ok">
		  				<p><?php echo htmlspecialchars($value->description); ?></p>
		  			</div>
		  	<?php if ($infosUser['id'] != $value->user_id) { ?>
			<div class="contact">
				<h2>Contact</h2>
				<?php 
					echo Form::open(array('url' => 'Messages/'. $value->user_id . '/create'));
						echo Form::text('object', null, array('placeholder' => 'object'));

						echo Form::textarea('content');

						echo Form::submit('envoyer');
					echo Form::close();
				?>
			</div>
			<?php } ?>
			
			@endforeach
			</div>
		</div>
	</body>
</html>
<?php } else { echo "Vous n'avez pas accès a cette page"; } ?>