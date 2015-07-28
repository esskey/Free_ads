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
		<title>Résultat recherche</title>
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

			@foreach ($annonce as $value)
			<div class="annonces">
					<div class="heada">
						<h2><?php echo Html::link('/annonce/'.$value->id, $value->titre) ?></h2>
						<p class="created">publier le <?php echo $value->created_at; ?> par <span class="by"> <?php echo $value->username; ?></span></p>
					</div>

					<div class="image">
						<?php echo Html::image('../storage/'.$value->user_id.'/'.$value->id.'/'.$value->nom) ?>
					</div>
					
					<div class="descr">
						<p><?php echo htmlspecialchars($value->description); ?></p>
					</div>

					<div class="prix">
						<p><?php echo $value->prix; ?> €</p>
					</div>
					
					<?php if ($infosUser['id'] == $value->user_id) { ?>
					<div class="supp">
							<?php echo Html::link('Annonces/'. $value->id . '/delete', 'Supprimer'); ?>
					</div>
					<?php
							} 
						?>
			</div>
			@endforeach
		</div>
	</body>
</html>
<?php } else { echo "Vous n'avez pas accès a cette page"; } ?>